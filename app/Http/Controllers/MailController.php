<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailDefault;
use App\Models\Mail;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Gate;
use App\Models\Contact;
use Carbon\Carbon;

class MailController extends Controller
{
    public function index(Request $request)
    {
       
            $mails = Mail::paginate(10);
            $contacts = Contact::get();
            return Inertia::render('Mail/Mail', compact('mails', 'contacts'));
       
    }

    public function store(Request $request)
    {
       

            $this->validate(
                $request,
                [
                    'title' => 'required',
                    'content' => 'required',

                ]
            );
            Mail::create([
                'title' => $request->title,
                'content' => $request->content
            ]);
            return back()->with('success', 'Create successfully');
      
    }
    public function update(Request $request, $id)
    {
      
            $mail = Mail::findOrFail($id);
            $this->validate(
                $request,
                [
                    'title' => 'required',
                    'content' => 'required',

                ]
            );
            $mail->update([
                'title' => $request->title,
                'content' => $request->content
            ]);
            return back()->with('success', 'Update successfully');
      
    }
    public function delete($id)
    {
      
            $mail = Mail::findOrFail($id);
            $mail->delete();
            return back()->with('success', 'Delete successfully');
      
    }
    public function sendMail(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'contacts' => 'required',

            ]
        );
        $mail = Mail::find($id);
        $contacts = Contact::find($request->contacts);
        $job = (new SendMailDefault($contacts, $mail))->delay(Carbon::now()->addSecond(2));
        dispatch($job);
        return back()->with('success', "Send mail successfully");
    }
    public function previewMail($id)
    {
        
            $mail = Mail::findOrFail($id);


            return view('preview-mail.preview_default', compact('mail'));
       
    }
}
