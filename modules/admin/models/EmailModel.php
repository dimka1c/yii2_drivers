<?php

namespace app\modules\admin\models;

class EmailModel extends \yii\base\Model
{
    public $host;
    public $host_username;
    public $host_password;
    public $mail;


    public function __construct(array $config)
    {
        $this->host = $config['email']['host'];
        $this->host_username = $config['email']['username'];
        $this->host_password = $config['email']['password'];
    }

    // получить письма из почтового ящика
    public function getMessages()
    {
        set_time_limit(60000);
        $ml = imap_open($this->host, $this->host_username, $this->host_password) or die('Cannot connect to: ' . $this->host . '. <b>ERROR</b>' . imap_last_error());
        if($ml) {
            $n = imap_num_msg($ml); //колво писем в ящике
            if ($n > 0) {
                $uids = array();
                $mails = array();
                for ($i=1; $i<=$n; $i++) {
                    $h = imap_header($ml, $i);
                    $h = $h->from;
                    foreach ($h as $k => $v) {
                        $mailbox = $v->mailbox;
                        $host = $v->host;
                        $personal = $v->personal;
                        $email = $mailbox . '@' . $host;
                        //return $mailbox . " / " . $host . " / " . $personal . " / " . $email;
                    }
                    $headerArr = imap_headerinfo($ml, $i);
                    $uid = imap_uid($ml, $headerArr->Msgno);
                    $mails[] = $email;
                    $uids[] = $uid;
                    $this->mail[$i]['uid'] = $uid;
                    $this->mail[$i]['email'] = $email;
                    $s = imap_fetch_overview($ml, $uid, FT_UID);
                    foreach ($s as $k => $v) {
                        $subj = imap_utf8($v->subject);
                        $this->mail[$i]['subj'] = $subj;
                    }
                }
            }
        }
        imap_close($ml);
        unset($ml);
        unset($headerArr);
        return $this->mail;
    }
}