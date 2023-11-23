<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('./vendor/autoload.php');

class SendProc
{
    public $obj;
    public $message;

    public function __construct($formData)
    {
        $this->obj = (object)$formData;
    }

    public function validate()
    {
        $formData = $this->obj;

        if ($this->isRequiredFieldsEmpty($formData)) {
            $this->message = "Please fill in all the required fields.";
            return true;
        }

        if (!$this->isValidEmail($formData->email)) {
            $this->message = "Invalid Email.";
            return true;
        }

        if (!$this->isValidCheckDates($formData->check_in_date, $formData->check_out_date)) {
            $this->message = "Invalid check-in or check-out date.";
            return true;
        }

        $this->message = "Validated";
        return false;
    }


    private function isRequiredFieldsEmpty($formData)
    {
        $requiredFields = ['name', 'email', 'phone', 'check_in_date', 'check_out_date', 'number_of_kids', 'number_of_adults'];

        foreach ($requiredFields as $field) {
            if (empty($formData->$field)) {
                return true;
            }
        }

        return false;
    }

    private function isValidEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function isValidCheckDates($checkInDate, $checkOutDate)
    {
        $checkInDateTime = new DateTime($checkInDate);
        $checkOutDateTime = new DateTime($checkOutDate);

        $today = new DateTime("today");

        return $checkInDateTime >= $today && $checkOutDateTime >= $checkInDateTime;
    }


    public function send()
    {
        $mailer = new  PHPMailer(true);
        $mailer->isSMTP();
        $mailer->Host = "smtp.gmail.com";
        $mailer->SMTPAuth = true;
        $mailer->Username = 'ndegwavincent7@gmail.com';
        $mailer->Password = 'feulzpogdvsvnidj';
        $mailer->Port = 587;
        $mailer->SMTPSecure = "tls";

        $mailer->isHTML(true);
        $mailer->setFrom("ndegwavincent7@gmail.com", "Booking");
        $mailer->Subject = $this->obj->name . " ,booking";

        $htmlFile = file_get_contents("./messages/booking.php");

        $replacement = array(
            "{{ name }}" => $this->obj->name,
            "{{ email }}" => $this->obj->email,
            "{{ phone }}" => $this->obj->phone,
            "{{ check_in_date }}" => $this->obj->check_in_date,
            "{{ check_out_date }}" => $this->obj->check_out_date,
            "{{ number_of_kids }}" => $this->obj->number_of_kids,
            "{{ number_of_adults }}" => $this->obj->number_of_adults,

        );
        $htmlReplace = str_replace(array_keys($replacement), array_values($replacement), $htmlFile);
        $mailer->Body = $htmlReplace;
        $mailer->addAddress("vincentndungu393@gmail.com");

        try {
            $mailer->send();
            return false;
            $this->message = "Message has been sent successfully";
        } catch (\Exception $th) {
            return true;
            $this->message = $th->getMessage();
        }
    }
}
