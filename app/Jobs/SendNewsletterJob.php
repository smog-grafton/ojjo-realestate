<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Newsletter;
use App\Models\Subscriber;
use App\Mail\NewsletterMail;
use Exception;

class SendNewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $newsletter;
    public $tries = 3;
    public $timeout = 120;

    /**
     * Create a new job instance.
     */
    public function __construct(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Mark newsletter as sending
            $this->newsletter->markAsSending();

            // Get active subscribers
            $subscribers = Subscriber::active()->get();
            $totalSubscribers = $subscribers->count();

            // Update total recipients
            $this->newsletter->update(['total_recipients' => $totalSubscribers]);

            $sentCount = 0;
            $failedCount = 0;
            $sendLog = [];

            Log::info("Starting newsletter send", [
                'newsletter_id' => $this->newsletter->id,
                'newsletter_name' => $this->newsletter->name,
                'total_subscribers' => $totalSubscribers
            ]);

            // Send to each subscriber
            foreach ($subscribers as $subscriber) {
                try {
                    Mail::send(new NewsletterMail($this->newsletter, $subscriber));
                    $sentCount++;
                    
                    Log::debug("Newsletter sent successfully", [
                        'newsletter_id' => $this->newsletter->id,
                        'subscriber_email' => $subscriber->email,
                        'subscriber_id' => $subscriber->id
                    ]);

                } catch (Exception $e) {
                    $failedCount++;
                    $errorMessage = $e->getMessage();
                    
                    $sendLog[] = [
                        'subscriber_id' => $subscriber->id,
                        'subscriber_email' => $subscriber->email,
                        'status' => 'failed',
                        'error' => $errorMessage,
                        'timestamp' => now()->toISOString()
                    ];

                    Log::error("Failed to send newsletter", [
                        'newsletter_id' => $this->newsletter->id,
                        'subscriber_email' => $subscriber->email,
                        'subscriber_id' => $subscriber->id,
                        'error' => $errorMessage
                    ]);
                }

                // Add small delay to prevent overwhelming mail server
                usleep(100000); // 0.1 second delay
            }

            // Update newsletter with final counts
            $this->newsletter->update([
                'sent_count' => $sentCount,
                'failed_count' => $failedCount,
                'send_log' => array_merge($this->newsletter->send_log ?? [], $sendLog),
            ]);

            // Mark as sent or failed based on results
            if ($sentCount > 0) {
                $this->newsletter->markAsSent();
                Log::info("Newsletter send completed successfully", [
                    'newsletter_id' => $this->newsletter->id,
                    'sent_count' => $sentCount,
                    'failed_count' => $failedCount,
                    'success_rate' => $this->newsletter->success_rate
                ]);
            } else {
                $this->newsletter->markAsFailed();
                Log::error("Newsletter send failed completely", [
                    'newsletter_id' => $this->newsletter->id,
                    'failed_count' => $failedCount
                ]);
            }

        } catch (Exception $e) {
            // Mark newsletter as failed if job fails completely
            $this->newsletter->markAsFailed();
            
            Log::error("Newsletter job failed", [
                'newsletter_id' => $this->newsletter->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(Exception $exception): void
    {
        $this->newsletter->markAsFailed();
        
        Log::error("Newsletter job failed after all retries", [
            'newsletter_id' => $this->newsletter->id,
            'newsletter_name' => $this->newsletter->name,
            'error' => $exception->getMessage(),
            'attempts' => $this->attempts()
        ]);
    }
}
