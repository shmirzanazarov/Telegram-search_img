<?
define('API_KEY','5544272245:AAEHXULTe308I92Q-VszuHh8Oqkjo3BIwso');
$admin = "1020678098";
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$name = $message->chat->first_name;
$text = $message->text;
$mid = $message->message_id;
$reply1 = $message->reply_to_message->text;

$btn = json_encode([
    'resize_keyboard'=>true,
    'keyboard' => [
        [['text' => "🔍Rasm Qidirish"],],
    ]
]);
$back = json_encode([
    'resize_keyboard'=>true,
    'keyboard' => [
        [['text' => "🔙bekor qilish"],],
    ]
]);

if($text == "/start"){
    bot('sendMessage', [
            'chat_id'=>$chat_id,
            'text'=>"Bot ishlayapti",
            'parse_mode'=>'markdown',
            'reply_markup' => $btn
    ]);
}

$rpl = json_encode([
    'resize_keyboard'=>false,
    'force_reply'=>true,
    'selective'=>true
]);

if($text == "🔍Rasm Qidirish"){
    bot('sendMessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$mid,
    'text'=>"✍🏻Qidirmoqchi bo'lgan rasm nomini yozing",
    'reply_markup'=>$rpl,
    ]);
}
if($reply1 == "✍🏻Qidirmoqchi bo'lgan rasm nomini yozing"){
    bot('sendMessage',[
        'chat_id'=>$chat_id,
        'text'=>"🔎Qidirilmoqda ➡️<b> $text </b>",
        'parse_mode'=>"HTML"
        ]);
        sleep(1);
    bot('editMessageText',[
        'chat_id'=>$chat_id,
        'message_id'=>$mid +1,
        'text'=>'⏳Yuklanmoqda

◼️◻️◻️◻️◻️20%'
        ]);
        sleep(1);
    bot('editMessageText',[
        'chat_id'=>$chat_id,
        'message_id'=>$mid +1,
        'text'=>'⏳Yuklanmoqda

◼️◼️◻️◻️◻️40%'
        ]);
        sleep(1);
    bot('editMessageText',[
        'chat_id'=>$chat_id,
        'message_id'=>$mid + 1,
        'text'=>'⏳Yuklanmoqda

◼️◼️◼️◻️◻️60%'
        ]);
        sleep(1);
    bot('editMessageText',[
        'chat_id'=>$chat_id,
        'message_id'=>$mid + 1,
        'text'=>'⏳Yuklanmoqda

◼️◼️◼️◼️◻️80%'
        ]);
        sleep(1);
    bot('editMessageText',[
        'chat_id'=>$chat_id,
        'message_id'=>$mid + 1,
        'text'=>'⏳Yuklanmoqda

◼️◼️◼️◼️◼️100%'
        ]);
        sleep(1);
    bot('editMessageText',[
        'chat_id'=>$chat_id,
        'message_id'=>$mid + 1,
        'text'=>'Yuklandi✅'
        ]);
         
        // sleep(1);
   
    bot('sendPhoto',[
        'chat_id'=>$chat_id,
        'photo'=>"https://yandex.uz/images/touch/search/?text=$text",
        'caption'=>"Rasmingiz topildi",
        'parse_mode'=>'html',
        'reply_markup'=>$btn,
    ]);
}

 if($text == "🔙bekor qilish"){
    bot('sendMessage', [
        'chat_id'=>$chat_id,
        'text'=>"❗️bekor qilindi",
        'parse_mode'=>'markdown',
        'reply_markup' => $btn,
    ]);
}




?>