<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailRegister extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $intro, $full_name, $gender, $birthday, $university, $major,
            $email, $phone, $address, $skype_id, $gpa, $cv;

    public function __construct($intro, $full_name, $gender, $birthday, $university, $major,
                                $email, $phone, $address, $skype_id, $gpa, $cv)
    {
        $this->intro = $intro;
        $this->full_name = $full_name;
        $this->gender = $gender;
        $this->birthday = $birthday;
        $this->university = $university;
        $this->major = $major;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->skype_id = $skype_id;
        $this->gpa = $gpa;
        $this->cv = $cv;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Student '.$this->full_name.' want to join your job!')
            ->attach($this->gpa, array(
                'as' => 'GPA File',
                'mime' => 'application/pdf'
            ))
            ->attach($this->cv, array(
                'as' => 'CV File',
                'mime' => 'application/pdf'
            ))
            ->view('student.sendEmailToCompany');
    }
}
