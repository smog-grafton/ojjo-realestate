<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    /**
     * Handle newsletter subscription
     */
    public function subscribe(Request $request)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'email' => 'required|email|max:255',
                'name' => 'nullable|string|max:255',
            ]);

            $email = $request->input('email');
            $name = $request->input('name');

            // Check if subscriber already exists
            $subscriber = Subscriber::where('email', $email)->first();

            if ($subscriber) {
                if ($subscriber->isSubscribed()) {
                    // Already subscribed
                    if ($request->expectsJson()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'This email is already subscribed to our newsletter.'
                        ], 409);
                    }
                    
                    return redirect()->back()->with('error', 'This email is already subscribed to our newsletter.');
                }
                
                // Previously unsubscribed, re-subscribe them
                $subscriber->subscribe();
                if ($name) {
                    $subscriber->update(['name' => $name]);
                }
                
                $message = 'Welcome back! You have been re-subscribed to our newsletter.';
            } else {
                // Create new subscriber
                $subscriber = Subscriber::create([
                    'email' => $email,
                    'name' => $name,
                    'subscribed_at' => now(),
                    'token' => Subscriber::generateUniqueToken(),
                ]);
                
                $message = 'Thank you for subscribing to our newsletter! You will receive updates about the latest property opportunities and market insights.';
            }

            // Return appropriate response
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $message
                ], 201);
            }

            return redirect()->back()->with('success', $message);

        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please enter a valid email address.',
                    'errors' => $e->errors()
                ], 422);
            }
            
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Please enter a valid email address.');
                
        } catch (\Exception $e) {
            Log::error('Newsletter subscription failed: ' . $e->getMessage());
            
            $errorMessage = 'Something went wrong while subscribing to the newsletter. Please try again later.';
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ], 500);
            }
            
            return redirect()->back()->with('error', $errorMessage);
        }
    }

    /**
     * Unsubscribe user from newsletter
     */
    public function unsubscribe(Request $request)
    {
        $email = $request->get('email');
        $token = $request->get('token');

        if (!$email || !$token) {
            return redirect()->route('newsletter.unsubscribe.error')
                ->with('error', 'Invalid unsubscribe link.');
        }

        $subscriber = Subscriber::where('email', $email)
            ->where('unsubscribe_token', $token)
            ->first();

        if (!$subscriber) {
            return redirect()->route('newsletter.unsubscribe.error')
                ->with('error', 'Invalid unsubscribe link or subscriber not found.');
        }

        // Update subscriber status
        $subscriber->update([
            'is_active' => false,
            'unsubscribed_at' => now(),
        ]);

        return redirect()->route('newsletter.unsubscribe.success')
            ->with('success', 'You have been successfully unsubscribed from our newsletter.');
    }

    /**
     * Show unsubscribe success page
     */
    public function unsubscribeSuccess()
    {
        return view('newsletter.unsubscribe-success');
    }

    /**
     * Show unsubscribe error page
     */
    public function unsubscribeError()
    {
        return view('newsletter.unsubscribe-error');
    }

    /**
     * Show newsletter management page (for authenticated users)
     */
    public function manage()
    {
        $totalSubscribers = Subscriber::count();
        $activeSubscribers = Subscriber::subscribed()->count();
        $unsubscribedCount = Subscriber::unsubscribed()->count();
        
        return view('newsletter.manage', compact('totalSubscribers', 'activeSubscribers', 'unsubscribedCount'));
    }
}
