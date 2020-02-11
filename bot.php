<?php 
error_reporting(true);
flush();
$botusername = "MyGlassyBot"; // نام کاربری ربات رو بدون @ بزارید
$update = json_decode(file_get_contents('php://input'));
$msg = $update->message;
$clbk = $update->callback_query;
$inln = $update->inline_query;
$chps = $update->channel_post;
$edms = $update->edit_message;
$edps = $update->edit_channel_post;
$rply = $msg->reply_to_message;
flush();
function send($method,$datas=[]){
$url = "https://api.telegram.org/bot0/".$method;  // توکن خود را بجای صفر قرار دهید
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
flush();
curl_close($ch);
return $res;}
function ifstr($ifs,$s1,$s2){
if($ifs){return $s1;}else{return $s2;}}
function str_rand($str,$leng = 1){
$lengeth = 1;$result = '';
if(str_replace('/','',$str) == $str){
$str = str_replace('0-9','0123456789',$str);
$str = str_replace('a-z','abcdefghijklmnopqrstuvwxyz',$str);
$str = str_replace('A-Z','ABCDEFGHIJKLMNOPQRSTUVWXYZ',$str);
$str = str_replace('ا-ی','ابپتثجچحخدذرزژسشصضطظعغفقکگلمنوهی',$str);
$str = str_replace('۰-۹','۰۱۲۳۴۵۶۷٨۹',$str);}else{
$str = str_replace('0-9','0/1/2/3/4/5/6/7/8/9',$str);
$str = str_replace('a-z','a/b/c/d/e/f/g/h/i/j/k/l/m/n/o/p/q/r/s/t/u/v/w/x/y/z',$str);
$str = str_replace('A-Z','A/B/C/D/E/F/G/H/I/J/K/L/M/N/O/P/Q/R/S/T/U/V/W/X/Y/Z',$str);
$str = str_replace('ا-ی','ا/ب/پ/ت/ث/ج/چ/ح/خ/د/ذ/ر/ز/ژ/س/ش/ص/ض/ط/ظ/ع/غ/ف/ق/ک/گ/ل/م/ن/و/ه/ی',$str);
$str = str_replace('۰-۹','۰/۱/۲/۳/۴/۵/۶/۷/٨/۹',$str);
}flush();while ($lengeth <= $leng){
if(str_replace('/','',$str) == $str){
$estr = str_split($str);}else{
$estr = explode('/',$str);}
$cstr = count($estr)-1;
$rstr = rand(0,$cstr);
$str_rand = $estr[$rstr];
$result = $result.$str_rand;
if($str_rand == true)
{$lengeth++;}flush();
}return $result;}
$data_ad = 'dataglass.php';
$data_gt = file_get_contents($data_ad);
$data = json_decode($data_gt,true);
$blocks = 'data/blocks.txt';
$gblocks = file_get_contents($blocks);
@mkdir("data/");
flush();


if($msg->text=='/ch' ){
$data['users'][$msg->chat->id]['lang'] = '';
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Please set your language.

لطفا زبان خود را انتخاب کنید.',
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🇺🇸 English"],['text'=>"🇮🇷 فارسی"]]
]])]);
}
if($msg->text=='🇮🇷 فارسی' && $data['users'][$msg->chat->id]['lang'] != 'fa' && $data['users'][$msg->chat->id]['lang'] != 'en'){
$data['users'][$msg->chat->id]['lang'] = 'fa';
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'سلام دوست عزیز، شما میتوانید از این ربات برای ساخت دکمه شیشه ای استفاده کنید.

 - /new : ساخت لیست شیشه ای

 - /alert : پیام مخفی

 - /hid : پیام مچگیر
 [پیام مخفی با ارسال اطلاعات]

 - /close : حذف پست ساخته شده

 - /var : متغییر های قابل استفاده

 - /cancel : لغو عملیات فعلی

 - /ch : 🇮🇷/🇺🇸

@MSXtm / Feel new things...',
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'remove_keyboard'=>true])
]);
}
if($msg->text=='🇺🇸 English' && $data['users'][$msg->chat->id]['lang'] != 'fa' && $data['users'][$msg->chat->id]['lang'] != 'en'){
$data['users'][$msg->chat->id]['lang'] = 'en';
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Hello Dear Friend, You can use this bot to make inline posts.

 - /new : Make a custom buttom post

 - /alert : Make a hidden post

 - /hid : Make a hidden post [it will send you the info of reader]

 - /close : Delete your post

 - /var : Available variables

 - /cancel : Call-off current process

 - /ch : 🇮🇷/🇺🇸

@MSXtm / Feel new things...',
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'remove_keyboard'=>true])
]);
}
if($msg->text=='/var'||$msg->text=='/Var'){
$data['users'][$msg->chat->id]['command'] = 'menu';
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'متغییرهای دردسترس برای شما

<code>[*FIRST_NAME*]</code> : نام شخص کلیک کننده

<code>[*LAST_NAME*]</code> : نام خانوادگی شخص کلیک کننده

<code>[*USERNAME*]</code> : نام کاربری شخص کلیک کننده

<code>[*USERID*]</code> : شناسه عددی شخص کلیک کننده',
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Available Variables

<code>[*FIRST_NAME*]</code> : Firstname of user

<code>[*LAST_NAME*]</code> : Lastname of user

<code>[*USERNAME*]</code> : Username of user

<code>[*USERID*]</code> : Id of user',
'parse_mode'=>"html",
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
}
elseif($msg->text=='/start'||$msg->text=='/Start'){
$data['users'][$msg->chat->id]['command'] = 'menu';
$user = file_get_contents('user.txt');
$members = explode("\n",$user);
if (!in_array($msg->chat->id,$members)){
$add_user = file_get_contents('user.txt');
$add_user .= $msg->chat->id."\n";
file_put_contents('user.txt',$add_user);
}
if($data['users'][$msg->chat->id]['lang'] != "fa" && $data['users'][$msg->chat->id]['lang'] != "en"){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Please set your language.

لطفا زبان خود را انتخاب کنید.',
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>"🇺🇸 English"],['text'=>"🇮🇷 فارسی"]]
]])]);
}
if($data['users'][$msg->chat->id]['lang'] == "fa"){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'سلام دوست عزیز، شما میتوانید از این ربات برای ساخت دکمه شیشه ای استفاده کنید.

 - /new : ساخت لیست شیشه ای

 - /alert : پیام مخفی

 - /hid : پیام مچگیر
 [پیام مخفی با ارسال اطلاعات]

 - /close : حذف پست ساخته شده

 - /var : متغییر های قابل استفاده

 - /cancel : لغو عملیات فعلی

 - /ch : 🇮🇷/🇺🇸

@MSXtm / Feel the new things...',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
if($data['users'][$msg->chat->id]['lang'] == "en"){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Hello Dear Friend, You can use this bot to make inline posts.

 - /new : Make a custom buttom post

 - /alert : Make a hidden post

 - /hid : Make a hidden post [it will send you the info of reader]

 - /close : Delete your post

 - /var : Available variables

 - /cancel : Call-off current process

 - /ch : 🇮🇷/🇺🇸

@MSXtm / Feel new things...',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
}elseif($inln->id){
if($data['code'][$inln->query]['type']=='alert'){
if($data['users'][$data['code'][$inln->query]['from']['id']]['lang'] == 'en'){
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'article',
'id'=>base64_encode(rand(5,555)),
'title'=>'alert - '.$data['code'][$inln->query]['text'],
'input_message_content'=>[
'message_text'=>$data['code'][$inln->query]['from']['first_name'].' have a hidden message for you.'],
'reply_markup'=>['inline_keyboard'=>[
[['text'=>'Read it','callback_data'=>'alert_'.$inln->query.'_a']]
]]
]])
]);
}
if($data['users'][$data['code'][$inln->query]['from']['id']]['lang'] == 'fa'){
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'article',
'id'=>base64_encode(rand(5,555)),
'title'=>'alert - '.$data['code'][$inln->query]['text'],
'input_message_content'=>[
'message_text'=>'کاربر '.$data['code'][$inln->query]['from']['first_name'].' برای شما یک پیام مخفی دارد.'],
'reply_markup'=>['inline_keyboard'=>[
[['text'=>'خواندن پیام','callback_data'=>'alert_'.$inln->query.'_a']]
]]
]])
]);
}
}
elseif($data['code'][$inln->query]['type']=='hid'){
if($data['users'][$data['code'][$inln->query]['from']['id']]['lang'] == 'fa'){
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'article',
'id'=>base64_encode(rand(5,555)),
'title'=>'hid - '.$data['code'][$inln->query]['text'],
'input_message_content'=>[
'message_text'=>'کاربر '.$data['code'][$inln->query]['from']['first_name'].' برای شما یک پیام مخفی دارد.'],
'reply_markup'=>['inline_keyboard'=>[
[['text'=>'خواندن پیام','callback_data'=>'hid_'.$inln->query.'_a']]
]]
]])
]);
}
if($data['users'][$data['code'][$inln->query]['from']['id']]['lang'] == 'en'){
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'article',
'id'=>base64_encode(rand(5,555)),
'title'=>'hid - '.$data['code'][$inln->query]['text'],
'input_message_content'=>[
'message_text'=>$data['code'][$inln->query]['from']['first_name'].' have a hidden message for you.'],
'reply_markup'=>['inline_keyboard'=>[
[['text'=>'Read it','callback_data'=>'hid_'.$inln->query.'_a']]
]]
]])
]);
}
}elseif($inln->id){
if($data['code'][$inln->query]['type']=='alert'){
if($data['users'][$data['code'][$inln->query]['from']['id']]['lang'] == 'fa'){
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'article',
'id'=>base64_encode(rand(5,555)),
'title'=>'alert - '.$data['code'][$inln->query]['text'],
'input_message_content'=>[
'message_text'=>'کاربر '.$data['code'][$inln->query]['from']['first_name'].' برای شما یک پیام مخفی دارد.'],
'reply_markup'=>['inline_keyboard'=>[
[['text'=>'خواندن پیام','callback_data'=>'alert_'.$inln->query.'_a']]
]]
]])
]);
}
if($data['users'][$data['code'][$inln->query]['from']['id']]['lang'] == 'en'){
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'article',
'id'=>base64_encode(rand(5,555)),
'title'=>'alert - '.$data['code'][$inln->query]['text'],
'input_message_content'=>[
'message_text'=>$data['code'][$inln->query]['from']['first_name'].' have a hidden message for you.'],
'reply_markup'=>['inline_keyboard'=>[
[['text'=>'Read it','callback_data'=>'alert_'.$inln->query.'_a']]
]]
]])
]);
}
}elseif($data['code'][$inln->query]['type']=='create'){
$text = str_replace([
'[*FIRST_NAME*]',
'[*LAST_NAME*]',
'[*USERNAME*]',
'[*USERID*]'
],'',$data['code'][$inln->query]['up']['text']);
$text = preg_replace([
'/\[\*(CLICK|VIEW|LIKE)_[0-9]{1,}\*\]/',
'/\[\*LIST_.{0,}_(VIEW|LIKE)_[0-9]{1,}_(FIRST_NAME|LAST_NAME|USERNAME|USERID)\*\]/',
'/\*\{[0-9\+\-\/\^\%\*\.\(\)\[\]]{1,}\*\}/'
],[
0,'',0
],$text);
flush();
$key_text = str_replace([
'[*FIRST_NAME*]',
'[*LAST_NAME*]',
'[*USERNAME*]',
'[*USERID*]'
],'',json_encode($data['code'][$inln->query]['keyboard']));
$key_text = json_decode(preg_replace([
'/\[\*(CLICK|VIEW|LIKE)_[0-9]{1,}\*\]/',
'/\[\*LIST_.{0,}_(VIEW|LIKE)_[0-9]{1,}_(FIRST_NAME|LAST_NAME|USERNAME|USERID)\*\]/',
'/\*\{[0-9\+\-\/\^\%\*\.\(\)\[\]]{1,}\*\}/'
],[
0,'',0
],$key_text),true);
if($data['code'][$inln->query]['up']['type']=='text'){
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'article',
'id'=>base64_encode(rand(5,555)),
'title'=>'create - '.$data['code'][$inln->query]['up']['text'],
'input_message_content'=>[
'message_text'=>$text],
'parse_mode'=>'HTML',
'reply_markup'=>['inline_keyboard'=>$key_text]
]])]);
}elseif($data['code'][$inln->query]['up']['type']=='photo'){
if($data['code'][$inln->query]['up']['text']){
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'photo',
'id'=>base64_encode(rand(5,555)),
'title'=>'create - photo - '.$data['code'][$inln->query]['up']['text'],
'photo_file_id'=>$data['code'][$inln->query]['up']['address'],
'caption'=>$text,
'reply_markup'=>[
'inline_keyboard'=>$key_text]
]])]);}
else{
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'photo',
'id'=>base64_encode(rand(5,555)),
'title'=>'create - photo - '.$data['code'][$inln->query]['up']['text'],
'photo_file_id'=>$data['code'][$inln->query]['up']['address'],
'reply_markup'=>[
'inline_keyboard'=>$key_text]
]])]);}
}elseif($data['code'][$inln->query]['up']['type']=='voice'){
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'voice',
'id'=>base64_encode(rand(5,555)),
'title'=>'create - voice - '.$data['code'][$inln->query]['up']['text'],
'voice_file_id'=>$data['code'][$inln->query]['up']['address'],
'reply_markup'=>[
'inline_keyboard'=>$key_text]
]])]);
}elseif($data['code'][$inln->query]['up']['type']=='video'){
if($data['code'][$inln->query]['up']['text']){
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'video',
'id'=>base64_encode(rand(5,555)),
'title'=>'create - video - '.$data['code'][$inln->query]['up']['text'],
'video_file_id'=>$data['code'][$inln->query]['up']['address'],
'caption'=>$text,
'reply_markup'=>[
'inline_keyboard'=>$key_text]
]])]);}
else{
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'video',
'id'=>base64_encode(rand(5,555)),
'title'=>'create - video - '.$data['code'][$inln->query]['up']['text'],
'video_file_id'=>$data['code'][$inln->query]['up']['address'],
'reply_markup'=>[
'inline_keyboard'=>$key_text]
]])]);}
}elseif($data['code'][$inln->query]['up']['type']=='audio'){
if($data['code'][$inln->query]['up']['text']){
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'audio',
'id'=>base64_encode(rand(5,555)),
'title'=>'create - audio - '.$data['code'][$inln->query]['up']['text'],
'audio_file_id'=>$data['code'][$inln->query]['up']['address'],
'caption'=>$text,
'reply_markup'=>[
'inline_keyboard'=>$key_text]
]])]);}
else{
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'audio',
'id'=>base64_encode(rand(5,555)),
'title'=>'create - audio - '.$data['code'][$inln->query]['up']['text'],
'audio_file_id'=>$data['code'][$inln->query]['up']['address'],
'reply_markup'=>[
'inline_keyboard'=>$key_text]
]])]);}
}elseif($data['code'][$inln->query]['up']['type']=='sticker'){
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'sticker',
'id'=>base64_encode(rand(5,555)),
'title'=>'create - sticker - '.$data['code'][$inln->query]['up']['text'],
'sticker_file_id'=>$data['code'][$inln->query]['up']['address'],
'reply_markup'=>[
'inline_keyboard'=>$key_text]
]])]);
}elseif($data['code'][$inln->query]['up']['type']=='document'){
if($data['code'][$inln->query]['up']['text']){
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'document',
'id'=>base64_encode(rand(5,555)),
'title'=>'create - document - '.$data['code'][$inln->query]['up']['text'],
'document_file_id'=>$data['code'][$inln->query]['up']['address'],
'caption'=>$text,
'reply_markup'=>[
'inline_keyboard'=>$key_text]
]])]);}
else{
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'document',
'id'=>base64_encode(rand(5,555)),
'title'=>'create - document - '.$data['code'][$inln->query]['up']['text'],
'document_file_id'=>$data['code'][$inln->query]['up']['address'],
'reply_markup'=>[
'inline_keyboard'=>$key_text]
]])]);}
}
}elseif($inln->query==''){
}else{
if($data['users'][$data['code'][$inln->query]['from']['id']]['lang'] == 'fa'){
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'article',
'id'=>base64_encode(rand(5,555)),
'title'=>'یافت نشد!',
'input_message_content'=>['message_text'=>'کد '.$inln->query.' یافت نشد!
۱. کد نادرست است.
۲. خطایی از طرف سیستم رخ داده است.
لطفا مجدد امتحان کنید.']
]])]);
}
if($data['users'][$data['code'][$inln->query]['from']['id']]['lang'] == 'en'){
send('answerInlineQuery',[
'inline_query_id'=>$inln->id,
'results'=>json_encode([[
'type'=>'article',
'id'=>base64_encode(rand(5,555)),
'title'=>'یافت نشد!',
'input_message_content'=>['message_text'=>$inln->query.' Has not been found!
1. Code is wrong.
2. An error occurred from servers.
Please try again.']
]])]);
}
}}}else if($clbk->id==true && $clbk->inline_message_id==true){
$code = explode('_',$clbk->data)[1];
$type = explode('_',$clbk->data)[0];
$button = explode('_',$clbk->data)[2];
if($data['code'][$code]['from']['id']==false){
send('editMessageReplyMarkup',[
'inline_message_id'=>$clbk->inline_message_id,
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'closed!','callback_data'=>'close_close_close']]]])]);
send('answerCallbackQuery',[
'callback_query_id'=>$clbk->id,
'text'=>'This post has been deleted!']);
}elseif($type=='close'){
send('answerCallbackQuery',[
'callback_query_id'=>$clbk->id,
'text'=>'This post has been deleted!']);
}elseif($type=='alert'){
$data['code'][$code]['click']++;
if($data['code'][$code]['views']['id'][$clbk->from->id]==false){
$data['code'][$code]['view']++;
$data['code'][$code]['views']['id'][$clbk->from->id] = $clbk->from->id;
$data['code'][$code]['views']['first_name'][$clbk->from->id] = $clbk->from->first_name;
$data['code'][$code]['views']['last_name'][$clbk->from->id] = $clbk->from->last_name;
$data['code'][$code]['views']['username'][$clbk->from->id] = $clbk->from->username;
}
if($data['code'][$code]['likes']['id'][$clbk->from->id]==false){
$data['code'][$code]['like']++;
$data['code'][$code]['likes']['id'][$clbk->from->id] = $clbk->from->id;
$data['code'][$code]['likes']['first_name'][$clbk->from->id] = $clbk->from->first_name;
$data['code'][$code]['likes']['last_name'][$clbk->from->id] = $clbk->from->last_name;
$data['code'][$code]['likes']['username'][$clbk->from->id] = $clbk->from->username;
}else{
$data['code'][$code]['like']--;
unset($data['code'][$code]['likes']['username'][$clbk->from->id]);
unset($data['code'][$code]['likes']['id'][$clbk->from->id]);
unset($data['code'][$code]['likes']['first_name'][$clbk->from->id]);
unset($data['code'][$code]['likes']['last_name'][$clbk->from->id]);}
$text = str_replace([
'[*CODE*]',
'[*FIRST_NAME*]',
'[*LAST_NAME*]',
'[*USERNAME*]',
'[*USERID*]',
'[*CLICK_1*]',
'[*VIEW_1*]',
'[*LIKE_1*]',
'[*THIS*]',
'[*CLICKED*]'
],[
$code,
$clbk->from->first_name,
$clbk->from->last_name,
$clbk->from->username,
$clbk->from->id,
$data['code'][$code]['click'],
$data['code'][$code]['view'],
$data['code'][$code]['like'],
$button,
$button
],$data['code'][$code]['text']);
flush();
preg_match_all('/\[\*LIST_(.{1,})_VIEW_1_USERNAME\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_VIEW_1_USERNAME*]',implode($impl,$data['code'][$code]['views']['username']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_VIEW_1_USERID\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_VIEW_1_USERID*]',implode($impl,$data['code'][$code]['views']['id']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_VIEW_1_FIRST_NAME\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_VIEW_1_FIRST_NAME*]',implode($impl,$data['code'][$code]['views']['first_name']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_VIEW_1_LAST_NAME\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_VIEW_1_LAST_NAME*]',implode($impl,$data['code'][$code]['views']['last_name']),$text);}
preg_match_all('/\[\*LIST_([.\n\t\r]{1,})_LIKE_1_USERNAME\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_LIKE_1_USERNAME*]',implode($impl,$data['code'][$code]['likes']['username']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_1_USERID\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_LIKE_1_USERID*]',implode($impl,$data['code'][$code]['likes']['id']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_1_FIRST_NAME\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_LIKE_1_FIRST_NAME*]',implode($impl,$data['code'][$code]['likes']['first_name']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_1_LAST_NAME\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_LIKE_1_LAST_NAME*]',implode($impl,$data['code'][$code]['likes']['last_name']),$text);}
flush();
preg_match_all('/\{\*([0-9\.\+\-\*\/\%\^\(\)\[\]]{1,})\*\}/',$text,$list_view);
foreach($list_view[1] as $impl){
eval('$ress = '.$impl.';');
$text = str_replace('{*'.$impl.'*}',$ress,$text);}
$text = str_replace('[*Nspace*]',"/n",$text);
flush();
send('answerCallbackQuery',[
'callback_query_id'=>$clbk->id,
'text'=>$text,
'show_alert'=>true]);
}elseif($type=='hid'){
$data['code'][$code]['click']++;
if($data['code'][$code]['views']['id'][$clbk->from->id]==false){
$data['code'][$code]['view']++;
$data['code'][$code]['views']['id'][$clbk->from->id] = $clbk->from->id;
$data['code'][$code]['views']['first_name'][$clbk->from->id] = $clbk->from->first_name;
$data['code'][$code]['views']['last_name'][$clbk->from->id] = $clbk->from->last_name;
$data['code'][$code]['views']['username'][$clbk->from->id] = $clbk->from->username;
}
if($data['code'][$code]['likes']['id'][$clbk->from->id]==false){
$data['code'][$code]['like']++;
$data['code'][$code]['likes']['id'][$clbk->from->id] = $clbk->from->id;
$data['code'][$code]['likes']['first_name'][$clbk->from->id] = $clbk->from->first_name;
$data['code'][$code]['likes']['last_name'][$clbk->from->id] = $clbk->from->last_name;
$data['code'][$code]['likes']['username'][$clbk->from->id] = $clbk->from->username;
}else{
$data['code'][$code]['like']--;
unset($data['code'][$code]['likes']['username'][$clbk->from->id]);
unset($data['code'][$code]['likes']['id'][$clbk->from->id]);
unset($data['code'][$code]['likes']['first_name'][$clbk->from->id]);
unset($data['code'][$code]['likes']['last_name'][$clbk->from->id]);}
$text = str_replace([
'[*CODE*]',
'[*FIRST_NAME*]',
'[*LAST_NAME*]',
'[*USERNAME*]',
'[*USERID*]',
'[*CLICK_1*]',
'[*VIEW_1*]',
'[*LIKE_1*]',
'[*THIS*]',
'[*CLICKED*]'
],[
$code,
$clbk->from->first_name,
$clbk->from->last_name,
$clbk->from->username,
$clbk->from->id,
$data['code'][$code]['click'],
$data['code'][$code]['view'],
$data['code'][$code]['like'],
$button,
$button
],$data['code'][$code]['text']);
flush();
preg_match_all('/\[\*LIST_(.{1,})_VIEW_1_USERNAME\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_VIEW_1_USERNAME*]',implode($impl,$data['code'][$code]['views']['username']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_VIEW_1_USERID\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_VIEW_1_USERID*]',implode($impl,$data['code'][$code]['views']['id']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_VIEW_1_FIRST_NAME\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_VIEW_1_FIRST_NAME*]',implode($impl,$data['code'][$code]['views']['first_name']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_VIEW_1_LAST_NAME\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_VIEW_1_LAST_NAME*]',implode($impl,$data['code'][$code]['views']['last_name']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_1_USERNAME\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_LIKE_1_USERNAME*]',implode($impl,$data['code'][$code]['likes']['username']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_1_USERID\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_LIKE_1_USERID*]',implode($impl,$data['code'][$code]['likes']['id']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_1_FIRST_NAME\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_LIKE_1_FIRST_NAME*]',implode($impl,$data['code'][$code]['likes']['first_name']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_1_LAST_NAME\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_LIKE_1_LAST_NAME*]',implode($impl,$data['code'][$code]['likes']['last_name']),$text);}
flush();
preg_match_all('/\{\*([0-9\.\+\-\*\/\%\^\(\)\[\]]{1,})\*\}/',$text,$list_view);
foreach($list_view[1] as $impl){
eval('$ress = '.$impl.';');
$text = str_replace('{*'.$impl.'*}',$ress,$text);}
$text = str_replace('[*Nspace*]',"/n",$text);
flush();
if($data['users'][$data['code'][$code]['from']['id']]['lang'] == 'fa'){
send('answerCallbackQuery',[
'callback_query_id'=>$clbk->id,
'text'=>$text,
'show_alert'=>true]);
send('sendMessage',[
'chat_id'=>$data['code'][$code]['from']['id'],
'text'=>'مچ کاربر جدیدی گرفته شد. ['.$code.']
شناسه: '.$clbk->from->id.'
نام: '.$clbk->from->first_name.'
'.
ifstr($clbk->from->last_name,'نام خانوادگی: '.$clbk->from->last_name.'
','').ifstr($clbk->from->username,'نام کاربری: @'.$clbk->from->username.'
','').ifstr($data['users'][$clbk->from->id]['command'],'کاربر در ربات حضور دارد','کاربر داخل این ربات عضو نیست')]);
}
if($data['users'][$data['code'][$code]['from']['id']]['lang'] == 'en'){
send('answerCallbackQuery',[
'callback_query_id'=>$clbk->id,
'text'=>$text,
'show_alert'=>true]);
send('sendMessage',[
'chat_id'=>$data['code'][$code]['from']['id'],
'text'=>'New user clicked on your button. ['.$code.']
ID: '.$clbk->from->id.'
Firstname: '.$clbk->from->first_name.'
'.
ifstr($clbk->from->last_name,'Lastname: '.$clbk->from->last_name.'
','').ifstr($clbk->from->username,'Username: @'.$clbk->from->username.'
','').ifstr($data['users'][$clbk->from->id]['command'],'User started this bot.','User did not start this bot.')]);
}
}elseif($type=='create'){
$data['code'][$code]['buttons'][$button]['click']++;
if( $data['code'][$code]['buttons'][$button]['views']['id'][$clbk->from->id]==false){
$data['code'][$code]['buttons'][$button]['view']++;
$data['code'][$code]['buttons'][$button]['views']['id'][$clbk->from->id] = $clbk->from->id;
$data['code'][$code]['buttons'][$button]['views']['username'][$clbk->from->id] = $clbk->from->username;
$data['code'][$code]['buttons'][$button]['views']['first_name'][$clbk->from->id] = $clbk->from->first_name;
$data['code'][$code]['buttons'][$button]['views']['last_name'][$clbk->from->id] = $clbk->from->last_name;
}
if($data['code'][$code]['likes'][$clbk->from->id]==false){
$data['code'][$code]['likes'][$clbk->from->id] = $button;
$data['code'][$code]['buttons'][$button]['like']++;
$data['code'][$code]['buttons'][$button]['likes']['id'][$clbk->from->id] = $clbk->from->id;
$data['code'][$code]['buttons'][$button]['likes']['username'][$clbk->from->id] = $clbk->from->username;
$data['code'][$code]['buttons'][$button]['likes']['first_name'][$clbk->from->id] = $clbk->from->first_name;
$data['code'][$code]['buttons'][$button]['likes']['last_name'][$clbk->from->id] = $clbk->from->last_name;
}elseif($data['code'][$code]['likes'][$clbk->from->id]!=$button){
$data['code'][$code]['buttons'][$data['code'][$code]['likes'][$clbk->from->id]]['like']--;
unset($data['code'][$code]['buttons'][$data['code'][$code]['likes'][$clbk->from->id]]['likes']['id'][$clbk->from->id]);
unset($data['code'][$code]['buttons'][$data['code'][$code]['likes'][$clbk->from->id]]['likes']['username'][$clbk->from->id]);
unset($data['code'][$code]['buttons'][$data['code'][$code]['likes'][$clbk->from->id]]['likes']['first_name'][$clbk->from->id]);
unset($data['code'][$code]['buttons'][$data['code'][$code]['likes'][$clbk->from->id]]['likes']['last_name'][$clbk->from->id]);
$data['code'][$code]['likes'][$clbk->from->id] = $button;
$data['code'][$code]['buttons'][$button]['like']++;
$data['code'][$code]['buttons'][$button]['likes']['id'][$clbk->from->id] = $clbk->from->id;
$data['code'][$code]['buttons'][$button]['likes']['username'][$clbk->from->id] = $clbk->from->username;
$data['code'][$code]['buttons'][$button]['likes']['first_name'][$clbk->from->id] = $clbk->from->first_name;
$data['code'][$code]['buttons'][$button]['likes']['last_name'][$clbk->from->id] = $clbk->from->last_name;
}elseif($data['code'][$code]['likes'][$clbk->from->id]==$button){
unset($data['code'][$code]['likes'][$clbk->from->id]);
unset($data['code'][$code]['buttons'][$button]['likes']['id'][$clbk->from->id]);
unset($data['code'][$code]['buttons'][$button]['likes']['username'][$clbk->from->id]);
unset($data['code'][$code]['buttons'][$button]['likes']['first_name'][$clbk->from->id]);
unset($data['code'][$code]['buttons'][$button]['likes']['last_name'][$clbk->from->id]);
$data['code'][$code]['buttons'][$button]['like']--;
}flush();
$text = $data['code'][$code]['buttons'][$button]['text'];
flush();
foreach($data['code'][$code]['buttons'] as $btn=>$btni){
$text = str_replace('[*THIS*]',$button,$text);
$text = str_replace([
'[*CODE*]',
'[*FIRST_NAME*]',
'[*LAST_NAME*]',
'[*USERNAME*]',
'[*USERID*]',
'[*CLICK_'.$btn.'*]',
'[*VIEW_'.$btn.'*]',
'[*LIKE_'.$btn.'*]'
],[
$code,
$clbk->from->first_name,
$clbk->from->last_name,
$clbk->from->username,
$clbk->from->id,
$data['code'][$code]['buttons'][$btn]['click'],
$data['code'][$code]['buttons'][$btn]['view'],
$data['code'][$code]['buttons'][$btn]['like']
],$text);
preg_match_all('/\[\*LIST_(.{1,})_VIEW_'.$btn.'_USERNAME\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_VIEW_'.$btn.'_USERNAME*]',implode($impl,$data['code'][$code]['buttons'][$btn]['views']['username']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_VIEW_'.$btn.'_USERID\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_VIEW_'.$btn.'_USERID*]',implode($impl,$data['code'][$code]['buttons'][$btn]['views']['id']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_VIEW_'.$btn.'_FIRST_NAME\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_VIEW_'.$btn.'_FIRST_NAME*]',implode($impl,$data['code'][$code]['buttons'][$btn]['views']['first_name']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_VIEW_'.$btn.'_LAST_NAME\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_VIEW_'.$btn.'_LAST_NAME*]',implode($impl,$data['code'][$code]['buttons'][$btn]['views']['last_name']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_'.$btn.'_USERNAME\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_LIKE_'.$btn.'_USERNAME*]',implode($impl,$data['code'][$code]['buttons'][$btn]['likes']['username']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_'.$btn.'_USERID\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_LIKE_'.$btn.'_USERID*]',implode($impl,$data['code'][$code]['buttons'][$btn]['likes']['id']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_'.$btn.'_FIRST_NAME\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_LIKE_'.$btn.'_FIRST_NAME*]',implode($impl,$data['code'][$code]['buttons'][$btn]['likes']['first_name']),$text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_'.$btn.'_LAST_NAME\*\]/',$text,$list_view);
foreach($list_view[1] as $impl){
$text = str_replace('[*LIST_'.$impl.'_LIKE_'.$btn.'_LAST_NAME*]',implode($impl,$data['code'][$code]['buttons'][$btn]['likes']['last_name']),$text);}
flush();
$up_text = str_replace([
'[*CODE*]',
'[*FIRST_NAME*]',
'[*LAST_NAME*]',
'[*USERNAME*]',
'[*USERID*]',
'[*CLICK_'.$btn.'*]',
'[*VIEW_'.$btn.'*]',
'[*LIKE_'.$btn.'*]'
],[
$code,
$clbk->from->first_name,
$clbk->from->last_name,
$clbk->from->username,
$clbk->from->id,
$data['code'][$code]['buttons'][$btn]['click'],
$data['code'][$code]['buttons'][$btn]['view'],
$data['code'][$code]['buttons'][$btn]['like']
],$data['code'][$code]['up']['text']);
preg_match_all('/\[\*LIST_(.{1,})_VIEW_'.$btn.'_USERNAME\*\]/',$up_text,$list_view);
foreach($list_view[1] as $impl){
$up_text = str_replace('[*LIST_'.$impl.'_VIEW_'.$btn.'_USERNAME*]',implode($impl,$data['code'][$code]['buttons'][$btn]['views']['username']),$up_text);}
preg_match_all('/\[\*LIST_(.{1,})_VIEW_'.$btn.'_USERID\*\]/',$up_text,$list_view);
foreach($list_view[1] as $impl){
$up_text = str_replace('[*LIST_'.$impl.'_VIEW_'.$btn.'_USERID*]',implode($impl,$data['code'][$code]['buttons'][$btn]['views']['id']),$up_text);}
preg_match_all('/\[\*LIST_(.{1,})_VIEW_'.$btn.'_FIRST_NAME\*\]/',$up_text,$list_view);
foreach($list_view[1] as $impl){
$up_text = str_replace('[*LIST_'.$impl.'_VIEW_'.$btn.'_FIRST_NAME*]',implode($impl,$data['code'][$code]['buttons'][$btn]['views']['first_name']),$up_text);}
preg_match_all('/\[\*LIST_(.{1,})_VIEW_'.$btn.'_LAST_NAME\*\]/',$up_text,$list_view);
foreach($list_view[1] as $impl){
$up_text = str_replace('[*LIST_'.$impl.'_VIEW_'.$btn.'_LAST_NAME*]',implode($impl,$data['code'][$code]['buttons'][$btn]['views']['last_name']),$up_text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_'.$btn.'_USERNAME\*\]/',$up_text,$list_view);
foreach($list_view[1] as $impl){
$up_text = str_replace('[*LIST_'.$impl.'_LIKE_'.$btn.'_USERNAME*]',implode($impl,$data['code'][$code]['buttons'][$btn]['likes']['username']),$up_text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_'.$btn.'_USERID\*\]/',$up_text,$list_view);
foreach($list_view[1] as $impl){
$up_text = str_replace('[*LIST_'.$impl.'_LIKE_'.$btn.'_USERID*]',implode($impl,$data['code'][$code]['buttons'][$btn]['likes']['id']),$up_text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_'.$btn.'_FIRST_NAME\*\]/',$up_text,$list_view);
foreach($list_view[1] as $impl){
$up_text = str_replace('[*LIST_'.$impl.'_LIKE_'.$btn.'_FIRST_NAME*]',implode($impl,$data['code'][$code]['buttons'][$btn]['likes']['first_name']),$up_text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_'.$btn.'_LAST_NAME\*\]/',$up_text,$list_view);
foreach($list_view[1] as $impl){
$up_text = str_replace('[*LIST_'.$impl.'_LIKE_'.$btn.'_LAST_NAME*]',implode($impl,$data['code'][$code]['buttons'][$btn]['likes']['last_name']),$up_text);}
flush();
$key_text = str_replace([
'[*CODE*]',
'[*FIRST_NAME*]',
'[*LAST_NAME*]',
'[*USERNAME*]',
'[*USERID*]',
'[*CLICK_'.$btn.'*]',
'[*VIEW_'.$btn.'*]',
'[*LIKE_'.$btn.'*]'
],[
$code,
$clbk->from->first_name,
$clbk->from->last_name,
$clbk->from->username,
$clbk->from->id,
$data['code'][$code]['buttons'][$btn]['click'],
$data['code'][$code]['buttons'][$btn]['view'],
$data['code'][$code]['buttons'][$btn]['like']
],json_encode($data['code'][$code]['keyboard']));
preg_match_all('/\[\*LIST_(.{1,})_VIEW_'.$btn.'_USERNAME\*\]/',$key_text,$list_view);
foreach($list_view[1] as $impl){
$key_text = str_replace('[*LIST_'.$impl.'_VIEW_'.$btn.'_USERNAME*]',implode($impl,$data['code'][$code]['buttons'][$btn]['views']['username']),$key_text);}
preg_match_all('/\[\*LIST_(.{1,})_VIEW_'.$btn.'_USERID\*\]/',$key_text,$list_view);
foreach($list_view[1] as $impl){
$key_text = str_replace('[*LIST_'.$impl.'_VIEW_'.$btn.'_USERID*]',implode($impl,$data['code'][$code]['buttons'][$btn]['views']['id']),$key_text);}
preg_match_all('/\[\*LIST_(.{1,})_VIEW_'.$btn.'_FIRST_NAME\*\]/',$key_text,$list_view);
foreach($list_view[1] as $impl){
$key_text = str_replace('[*LIST_'.$impl.'_VIEW_'.$btn.'_FIRST_NAME*]',implode($impl,$data['code'][$code]['buttons'][$btn]['views']['first_name']),$key_text);}
preg_match_all('/\[\*LIST_(.{1,})_VIEW_'.$btn.'_LAST_NAME\*\]/',$key_text,$list_view);
foreach($list_view[1] as $impl){
$key_text = str_replace('[*LIST_'.$impl.'_VIEW_'.$btn.'_LAST_NAME*]',implode($impl,$data['code'][$code]['buttons'][$btn]['views']['last_name']),$key_text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_'.$btn.'_USERNAME\*\]/',$key_text,$list_view);
foreach($list_view[1] as $impl){
$key_text = str_replace('[*LIST_'.$impl.'_LIKE_'.$btn.'_USERNAME*]',implode($impl,$data['code'][$code]['buttons'][$btn]['likes']['username']),$key_text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_'.$btn.'_USERID\*\]/',$key_text,$list_view);
foreach($list_view[1] as $impl){
$key_text = str_replace('[*LIST_'.$impl.'_LIKE_'.$btn.'_USERID*]',implode($impl,$data['code'][$code]['buttons'][$btn]['likes']['id']),$key_text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_'.$btn.'_FIRST_NAME\*\]/',$key_text,$list_view);
foreach($list_view[1] as $impl){
$key_text = str_replace('[*LIST_'.$impl.'_LIKE_'.$btn.'_FIRST_NAME*]',implode($impl,$data['code'][$code]['buttons'][$btn]['likes']['first_name']),$key_text);}
preg_match_all('/\[\*LIST_(.{1,})_LIKE_'.$btn.'_LAST_NAME\*\]/',$key_text,$list_view);
foreach($list_view[1] as $impl){
$key_text = str_replace('[*LIST_'.$impl.'_LIKE_'.$btn.'_LAST_NAME*]',implode($impl,$data['code'][$code]['buttons'][$btn]['likes']['last_name']),$key_text);}
flush();
}
preg_match_all('/\{\*([0-9\.\+\-\*\/\%\^\(\)\[\]]{1,})\*\}/',$text,$list_view);
foreach($list_view[1] as $impl){
eval('$ress = '.$impl.';');
$text = str_replace('{*'.$impl.'*}',$ress,$text);}
$text = str_replace('[*Nspace*]',"/n",$text);
flush();
preg_match_all('/\{\*([0-9\.\+\-\*\/\%\^\(\)\[\]]{1,})\*\}/',$up_text,$list_view);
foreach($list_view[1] as $impl){
eval('$ress = '.$impl.';');
$up_text = str_replace('{*'.$impl.'*}',$ress,$up_text);}
$up_text = str_replace('[*Nspace*]',"/n",$up_text);
flush();
preg_match_all('/\{\*([0-9\.\+\-\*\/\%\^\(\)\[\]]{1,})\*\}/',$key_text,$list_view);
foreach($list_view[1] as $impl){
eval('$ress = '.$impl.';');
$key_text = str_replace('{*'.$impl.'*}',$ress,$text);}
$key_text = str_replace('[*Nspace*]',"/n",$key_text);
$key_text = json_decode($key_text,true);
flush();
if($data['code'][$code]['buttons'][$button]['type']=='alert1'){
send('answerCallbackQuery',[
'callback_query_id'=>$clbk->id,
'text'=>$text]);
}elseif($data['code'][$code]['buttons'][$button]['type']=='alert2'){
send('answerCallbackQuery',[
'callback_query_id'=>$clbk->id,
'text'=>$text,
'show_alert'=>true]);
}elseif($data['code'][$code]['buttons'][$button]['type']=='send'){
send('sendMessage',[
'chat_id'=>$data['code'][$code]['from']['id'],
'text'=>$text]);
}elseif($data['code'][$code]['buttons'][$button]['type']=='edit'){
$data['code'][$code]['up']['text'] = $text;
$up_text = $text;
}
if($data['code'][$code]['up']['type']=='text'){
send('editMessageText',[
'inline_message_id'=>$clbk->inline_message_id,
'text'=>$up_text,
'parse_mode'=>'HTML',
'reply_markup'=>json_encode([
'inline_keyboard'=>$key_text])]);
}else{
send('editMessageCaption',[
'inline_message_id'=>$clbk->inline_message_id,
'caption'=>$up_text,
'parse_mode'=>'HTML',
'reply_markup'=>json_encode([
'inline_keyboard'=>$key_text])]);
}
}
}elseif($msg->text=='/cancel'){
$data['users'][$msg->chat->id]['command'] = 'menu';
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'عملیات بسته شد.',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Operation has been deleted.',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
}elseif($msg->text=='/close'){
$data['users'][$msg->chat->id]['command'] = 'close';
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'کد پست خودتون رو جهت حذف شدن بفرستید.']);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>"Enter your post's code to close(delete) it."]);
}
}elseif($msg->text&&$data['users'][$msg->chat->id]['command']=='close'){
if($data['code'][$msg->text]['from']['id']){
if($data['code'][$msg->text]['from']['id']==$msg->chat->id){
unset($data['code'][$msg->text]);
$data['users'][$msg->chat->id]['command'] = 'menu';
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'حذف شد.']);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Deleted.']);
}
}else{
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'پست وجود دارد، اما شما صاحب آن نیستید و نمیتوانید آن را حذف کنید.']);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'There is a post by that id, but you cannot delete it, Because it is not yours.']);
}
}}else{
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'پست وجود ندارد... دوباره امتحان کنید.']);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'There is no post with this id... Try again.']);
}
}}elseif($msg->text=='/alert'){
$data['users'][$msg->chat->id]['command'] = 'alert';
$data['count'] = $data['count']+rand(1,rand(1,99));
$code = base_convert($data['count'],10,36);
$data['code'][$code]['type'] = 'alert';
$data['code'][$code]['from']['id'] = $msg->chat->id;
$data['code'][$code]['from']['first_name'] = $msg->chat->first_name;
$data['code'][$code]['from']['last_name'] = $msg->chat->last_name;
$data['code'][$code]['from']['username'] = $msg->chat->username;
$data['users'][$msg->chat->id]['code']  = $code;
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'متن پیام رو وارد کنید.']);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Send your text.']);
}
}elseif($msg->text&&$data['users'][$msg->chat->id]['command']=='alert'){
$data['users'][$msg->chat->id]['command'] = 'menu';
$data['code'][$data['users'][$msg->chat->id]['code']]['text'] = $msg->text;
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'میتوانید پیام مخفی رو از طریق دکمه زیر به گفتگوی موردنظر بفرستید.',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'ارسال','switch_inline_query'=>$data['users'][$msg->chat->id]['code']]]
]])]);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'You can send your hidden message by the button below.',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'Send','switch_inline_query'=>$data['users'][$msg->chat->id]['code']]]
]])]);
}
}elseif($msg->text=='/hid'){
$data['users'][$msg->chat->id]['command'] = 'hid';
$data['count'] = $data['count']+rand(1,rand(1,99));
$code = base_convert($data['count'],10,36);
$data['code'][$code]['type'] = 'hid';
$data['code'][$code]['from']['id'] = $msg->chat->id;
$data['code'][$code]['from']['first_name'] = $msg->chat->first_name;
$data['code'][$code]['from']['last_name'] = $msg->chat->last_name;
$data['code'][$code]['from']['username'] = $msg->chat->username;
$data['users'][$msg->chat->id]['code']  = $code;
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'متن پیام رو وارد کنید.']);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Send your text.']);
}
}elseif($msg->text&&$data['users'][$msg->chat->id]['command']=='hid'){
$data['users'][$msg->chat->id]['command'] = 'menu';
$data['code'][$data['users'][$msg->chat->id]['code']]['text'] = $msg->text;
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'میتوانید پیام مچ گیر رو از طریق دکمه زیر به گفتگوی موردنظر بفرستید.',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'ارسال','switch_inline_query'=>$data['users'][$msg->chat->id]['code']]]
]])]);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'You can send your hidden message(info reciver) by the button below.',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'Send','switch_inline_query'=>$data['users'][$msg->chat->id]['code']]]
]])]);
}
}
elseif($msg->text=='/new'){
$data['users'][$msg->chat->id]['command'] = 'new1';
$data['count'] = $data['count']+rand(1,rand(1,99));
$code = base_convert($data['count'],10,36);
$data['code'][$code]['type'] = 'create';
$data['code'][$code]['from']['id'] = $msg->chat->id;
$data['code'][$code]['from']['first_name'] = $msg->chat->first_name;
$data['code'][$code]['from']['last_name'] = $msg->chat->last_name;
$data['code'][$code]['from']['username'] = $msg->chat->username;
$data['users'][$msg->chat->id]['code']  = $code;
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'محتوا رو ارسال کنید.(این محتوا عبارتی هست که بالای دکمه هاست و میتوانید هرچیزی باشد)']);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>"Send your post.(It's the media that is up the inline-buttons and it can be anything)"]);
}
}elseif($msg->message_id&&$data['users'][$msg->chat->id]['command']=='new1'){
if($msg->photo[5]->file_id){
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['type'] = 'photo';
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['address'] = $msg->photo[5]->file_id;
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['text'] = $msg->caption;
}elseif($msg->photo[4]->file_id){
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['type'] = 'photo';
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['address'] = $msg->photo[4]->file_id;
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['text'] = $msg->caption;
}elseif($msg->photo[3]->file_id){
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['type'] = 'photo';
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['address'] = $msg->photo[3]->file_id;
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['text'] = $msg->caption;
}elseif($msg->photo[2]->file_id){
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['type'] = 'photo';
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['address'] = $msg->photo[2]->file_id;
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['text'] = $msg->caption;
}elseif($msg->photo[1]->file_id){
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['type'] = 'photo';
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['address'] = $msg->photo[1]->file_id;
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['text'] = $msg->caption;
}elseif($msg->photo[0]->file_id){
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['type'] = 'photo';
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['address'] = $msg->photo[0]->file_id;
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['text'] = $msg->caption;
}elseif($msg->video->file_id){
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['type'] = 'video';
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['address'] = $msg->video->file_id;
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['text'] = $msg->caption;
}elseif($msg->audio->file_id){
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['type'] = 'audio';
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['address'] = $msg->audio->file_id;
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['text'] = $msg->caption;
}elseif($msg->voice->file_id){
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['type'] = 'voice';
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['address'] = $msg->voice->file_id;
}elseif($msg->sticker->file_id){
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['type'] = 'sticker';
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['address'] = $msg->sticker->file_id;
}elseif($msg->document){
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['type'] = 'document';
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['address'] = $msg->document->file_id;
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['text'] = $msg->caption;
}elseif($msg->text){
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['type'] = 'text';
$data['code'][$data['users'][$msg->chat->id]['code']]['up']['text'] = $msg->text;
}else{$nook = true;}if($nook){
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'محتوا قابل قبول نیست! مجدد امتحان کنید.']);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Your message is not a valid type! Try again.']);
}
}else{
$data['users'][$msg->chat->id]['command'] = 'new2';
$data['users'][$msg->chat->id]['btncount'] = 0;
$data['users'][$msg->chat->id]['countbtn'] = 1;
$data['users'][$msg->chat->id]['buttons'] = [];
$data['users'][$msg->chat->id]['button'] = [];
$data['users'][$msg->chat->id]['btn'] = [];
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'نوع دکمه رو مشخص کن:',
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'نمایش اخطار']],
[['text'=>'نمایش پیام']],
[['text'=>'بازکردن لینک']],
[['text'=>'ویرایش پیام']],
[['text'=>'دکمه بدون محتوا']],
[['text'=>'پیام به شما']],
[['text'=>'اشتراک گذاری پست']]
],'resize_keyboard'=>true])]);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Choose a button:',
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'Show Alert']],
[['text'=>'Show Message']],
[['text'=>'Open URL']],
[['text'=>'Edit Message']],
[['text'=>'Non-media Button']],
[['text'=>'Message to You']],
[['text'=>'Share Post']]
],'resize_keyboard'=>true])]);
}
}
}elseif($data['users'][$msg->chat->id]['command']=='new2'){
if($msg->text=='نمایش اخطار'||$msg->text=='Show Alert'){
$data['users'][$msg->chat->id]['btn']['type'] = 'alert1';
$data['users'][$msg->chat->id]['command'] = 'new3';
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'پیام خود را وارد کنید:',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Send your text:',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
}elseif($msg->text=='نمایش پیام'||$msg->text=='Show Message'){
$data['users'][$msg->chat->id]['btn']['type'] = 'alert2';
$data['users'][$msg->chat->id]['command'] = 'new3';
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'پیام خود را وارد کنید:',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Send your text:',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
}elseif($msg->text=='بازکردن لینک'||$msg->text=='Open URL'){
$data['users'][$msg->chat->id]['btn']['type'] = 'url';
$data['users'][$msg->chat->id]['command'] = 'new4';
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'لینک خود را وارد کنید:',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Send your URL:',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
}elseif($msg->text=='ویرایش پیام'||$msg->text=='Edit Message'){
$data['users'][$msg->chat->id]['btn']['type'] = 'edit';
$data['users'][$msg->chat->id]['command'] = 'new5';
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'پیام خود را وارد کنید:',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Send your text:',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
}elseif($msg->text=='دکمه بدون محتوا'||$msg->text=='Non-media Button'){
$data['users'][$msg->chat->id]['btn']['type'] = 'none';
$data['users'][$msg->chat->id]['command'] = 'new6';
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'نام دکمه را وارد کنید:',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>"Send the button's name:",
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
}elseif($msg->text=='پیام به شما'||$msg->text=='Message to You'){
$data['users'][$msg->chat->id]['btn']['type'] = 'send';
$data['users'][$msg->chat->id]['command'] = 'new7';
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'متنی که میخواهید با اجرای دکمه توسط کاربر، دریافت کنید را بفرستید:',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'There should be a text that you will recieve when user clicked on it, Send it:',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
}elseif($msg->text=='اشتراک گذاری پست'||$msg->text=='Share Post'){
$data['users'][$msg->chat->id]['btn']['type'] = 'share';
$data['users'][$msg->chat->id]['command'] = 'new8';
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'شما میتونید دکمه ای ایجاد کنید تا پستی دیگری که در همین ربات ساخته شده باشد به اشتراک گذاشته شود، یا همین پست به اشتراک گذاشته شود.
برای پست خارجی، شناسه اون پست و اگه میخواید همین پست باشه، عبارت . را ارسال کنید.',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'You can make a button that user can share a post by clicking on it.
If you want that users share a post that is already created by this bot, send your code and IF YOU WANT TO SHARE THE CURRENT POST, Send ".".',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
}elseif(($msg->text=='اتمام کار'||$msg->text=='Done'||$msg->text=='/done')&&$data['users'][$msg->chat->id]['buttons']!=[]){
$data['users'][$msg->chat->id]['command'] = 'menu';
$data['users'][$msg->chat->id]['up'] = [];
$data['code'][$data['users'][$msg->chat->id]['code']]['keyboard'] = $data['users'][$msg->chat->id]['buttons'];
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('deleteMessage',[
'chat_id'=>$msg->chat->id,
'message_id'=>json_decode(send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'درحال ایجاد کردن...',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]))->result->message_id]);
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'خب پست شما ایجاد شد، از دکمه زیر برای ارسال به گفتگوی موردنظر استفاده کنید.',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'ارسال','switch_inline_query'=>$data['users'][$msg->chat->id]['code']]]
]])]);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('deleteMessage',[
'chat_id'=>$msg->chat->id,
'message_id'=>json_decode(send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Creating...',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]))->result->message_id]);
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'So, your post has been created, Use the button below to send it.',
'reply_markup'=>json_encode([
'inline_keyboard'=>[
[['text'=>'Send','switch_inline_query'=>$data['users'][$msg->chat->id]['code']]]
]])]);
}
}elseif($msg->text=='پیشنمایش پست'||$msg->text=="Post's Preview"&&$data['users'][$msg->chat->id]['buttons']!=[]){
if($data['code'][$data['users'][$msg->chat->id]['code']]['up']['type']=='photo'){
send('sendPhoto',[
'chat_id'=>$msg->chat->id,
'photo'=>$data['code'][$data['users'][$msg->chat->id]['code']]['up']['address'],
'caption'=>$data['code'][$data['users'][$msg->chat->id]['code']]['up']['text'],
'reply_markup'=>json_encode([
'inline_keyboard'=>$data['users'][$msg->chat->id]['buttons']
])]);
}elseif($data['code'][$data['users'][$msg->chat->id]['code']]['up']['type']=='voice'){
send('sendVoice',[
'chat_id'=>$msg->chat->id,
'voice'=>$data['code'][$data['users'][$msg->chat->id]['code']]['up']['address'],
'caption'=>$data['code'][$data['users'][$msg->chat->id]['code']]['up']['text'],
'reply_markup'=>json_encode([
'inline_keyboard'=>$data['users'][$msg->chat->id]['buttons']
])]);
}elseif($data['code'][$data['users'][$msg->chat->id]['code']]['up']['type']=='video'){
send('sendVideo',[
'chat_id'=>$msg->chat->id,
'video'=>$data['code'][$data['users'][$msg->chat->id]['code']]['up']['address'],
'caption'=>$data['code'][$data['users'][$msg->chat->id]['code']]['up']['text'],
'reply_markup'=>json_encode([
'inline_keyboard'=>$data['users'][$msg->chat->id]['buttons']
])]);
}elseif($data['code'][$data['users'][$msg->chat->id]['code']]['up']['type']=='audio'){
send('sendAudio',[
'chat_id'=>$msg->chat->id,
'audio'=>$data['code'][$data['users'][$msg->chat->id]['code']]['up']['address'],
'caption'=>$data['code'][$data['users'][$msg->chat->id]['code']]['up']['text'],
'reply_markup'=>json_encode([
'inline_keyboard'=>$data['users'][$msg->chat->id]['buttons']
])]);
}elseif($data['code'][$data['users'][$msg->chat->id]['code']]['up']['type']=='sticker'){
send('sendSticker',[
'chat_id'=>$msg->chat->id,
'sticker'=>$data['code'][$data['users'][$msg->chat->id]['code']]['up']['address'],
'caption'=>$data['code'][$data['users'][$msg->chat->id]['code']]['up']['text'],
'reply_markup'=>json_encode([
'inline_keyboard'=>$data['users'][$msg->chat->id]['buttons']
])]);
}elseif($data['code'][$data['users'][$msg->chat->id]['code']]['up']['type']=='document'){
send('sendDocument',[
'chat_id'=>$msg->chat->id,
'document'=>$data['code'][$data['users'][$msg->chat->id]['code']]['up']['address'],
'caption'=>$data['code'][$data['users'][$msg->chat->id]['code']]['up']['text'],
'reply_markup'=>json_encode([
'inline_keyboard'=>$data['users'][$msg->chat->id]['buttons']
])]);
}elseif($data['code'][$data['users'][$msg->chat->id]['code']]['up']['type']=='text'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>$data['code'][$data['users'][$msg->chat->id]['code']]['up']['text'],
'reply_markup'=>json_encode([
'inline_keyboard'=>$data['users'][$msg->chat->id]['buttons']
])]);
}
}
}elseif($data['users'][$msg->chat->id]['command']=='new3'&&$msg->text){
$data['users'][$msg->chat->id]['btn']['text'] = $msg->text;
$data['users'][$msg->chat->id]['command'] = 'new6';
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'نام دکمه را وارد کنید:',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>"Send your button's name:",
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
}elseif($data['users'][$msg->chat->id]['command']=='new4'&&$msg->text){
if(file_get_contents($msg->text)==true||str_replace('code://','',$msg->text)!=$msg->text){
$msg_text = str_replace('code://','http://',$msg->text);
$data['users'][$msg->chat->id]['command'] = 'new6';
$data['users'][$msg->chat->id]['btn']['url'] = $msg_text;
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'نام دکمه را وارد کنید:',
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>"Send your button's name:",
'reply_markup'=>json_encode([
'remove_keyboard'=>true])]);
}
}else{
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'لینک معتبر نیست!
لینک باید با http:// یا https:// شروع شود.']);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'URL is wrong!
It have to start by (http://) or (https://).']);
}
}
}elseif($data['users'][$msg->chat->id]['command']=='new5'&&$msg->message_id){
$data['users'][$msg->chat->id]['command'] = 'new6';
if($msg->photo[5]->file_id){
$msgid = json_decode(send('sendPhoto',[
'chat_id'=>'@MSXtm',
'photo'=>$msg->photo[5]->file_id]))->result->message_id;
}elseif($msg->photo[4]->file_id){
$msgid = json_decode(send('sendPhoto',[
'chat_id'=>'@MSXtm',
'photo'=>$msg->photo[4]->file_id]))->result->message_id;
}elseif($msg->photo[3]->file_id){
$msgid = json_decode(send('sendPhoto',[
'chat_id'=>'@MSXtm',
'photo'=>$msg->photo[3]->file_id]))->result->message_id;
}elseif($msg->photo[2]->file_id){
$msgid = json_decode(send('sendPhoto',[
'chat_id'=>'@MSXtm',
'photo'=>$msg->photo[2]->file_id]))->result->message_id;
}elseif($msg->photo[1]->file_id){
$msgid = json_decode(send('sendPhoto',[
'chat_id'=>'@MSXtm',
'photo'=>$msg->photo[1]->file_id]))->result->message_id;
}elseif($msg->photo[0]->file_id){
$msgid = json_decode(send('sendPhoto',[
'chat_id'=>'@MSXtm',
'photo'=>$msg->photo[0]->file_id]))->result->message_id;
}elseif($msg->voice->file_id){
$msgid = json_decode(send('sendVoice',[
'chat_id'=>'@MSXtm',
'voice'=>$msg->voice->file_id]))->result->message_id;
}elseif($msg->video->file_id){
$msgid = json_decode(send('sendVideo',[
'chat_id'=>'@MSXtm',
'video'=>$msg->video->file_id]))->result->message_id;
}elseif($msg->audio->file_id){
$msgid = json_decode(send('sendAudio',[
'chat_id'=>'@MSXtm',
'audio'=>$msg->audio->file_id]))->result->message_id;
}elseif($msg->sticker->file_id){
$msgid = json_decode(send('sendSticker',[
'chat_id'=>'@MSXtm',
'sticker'=>$msg->sticker->file_id]))->result->message_id;
}elseif($msg->document->file_id){
$msgid = json_decode(send('sendDocument',[
'chat_id'=>'@MSXtm',
'document'=>$msg->document->file_id]))->result->message_id;
}elseif($msg->text){
$msgid = json_decode(send('sendMessage',[
'chat_id'=>'@MSXtm',
'text'=>$msg->text]))->result->message_id;
}else{$nook = true;}if($nook){
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'پیام مجاز نیست!']);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Message is not valid!']);
}
}else{flush();
if($msg->text){
$data['users'][$msg->chat->id]['btn']['text'] = $msg->text;
}elseif($msg->caption){
$data['users'][$msg->chat->id]['btn']['text'] = '<a href="http://t.me/'.$botusername.'/'.$msgid.'">‌‌‌</a>'.$msg->caption;
}else{
$data['users'][$msg->chat->id]['btn']['text'] = '<a href="http://t.me/'.$botusername.'/'.$msgid.'">‌‌‌</a> ‌‌';}
$data['users'][$msg->chat->id]['command'] = 'new6';
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'نام دکمه را وارد کنید:']);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>"Send your button's name:"]);
}
}
}elseif($data['users'][$msg->chat->id]['command']=='new6'&&$msg->text){
$data['users'][$msg->chat->id]['command'] = 'new9';
$data['users'][$msg->chat->id]['btn']['name'] = $msg->text;
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'مکان قرارگیری دکمه کجا باشد؟',
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'ردیف قبلی']],
[['text'=>'ردیف جدید']]
],'resize_keyboard'=>true])]);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Where should I put your button?',
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'Previous Row']],
[['text'=>'New Row']]
],'resize_keyboard'=>true])]);
}
}elseif($data['users'][$msg->chat->id]['command']=='new7'&&$msg->text){
$data['users'][$msg->chat->id]['btn']['text'] = $msg->text;
$data['users'][$msg->chat->id]['command'] = 'new6';
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'نام دکمه را وارد کنید:']);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>"Send your button's name:"]);
}
}elseif($data['users'][$msg->chat->id]['command']=='new8'&&$msg->text){
if($msg->text=='.'){
$msg_text = $data['users'][$msg->chat->id]['code'];}else{
$msg_text = $msg->text;}
if($msg->text=='.'||$data['code'][$msg_text]['from']['id']==true){
$data['users'][$msg->chat->id]['btn']['code'] = $msg_text;
$data['users'][$msg->chat->id]['command'] = 'new6';
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'نام دکمه را وارد کنید:']);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>"Send your button's name:"]);
}
}else{
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'کد اشتباه است!']);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Code is wrong!']);
}
}
}elseif($data['users'][$msg->chat->id]['command']=='new9'&&$msg->text){
if($msg->text=='ردیف قبلی'||$msg->text=='Previous Row'){
}elseif($msg->text=='ردیف جدید'||$msg->text=='New Row'){
if($data['users'][$msg->chat->id]['buttons']!=[]){
$data['users'][$msg->chat->id]['btncount']++;
$data['users'][$msg->chat->id]['buttons'][$data['users'][$msg->chat->id]['btncount']] = [];}
}else{$nook = true;}if($nook){
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'نوع دکمه رو مشخص کن:']);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Choose a button:']);
}
}else{
$data['users'][$msg->chat->id]['btn']['like'] = 0;
$data['users'][$msg->chat->id]['btn']['view'] = 0;
$data['users'][$msg->chat->id]['btn']['click'] = 0;
if($data['users'][$msg->chat->id]['btn']['type']=='alert1'||$data['users'][$msg->chat->id]['btn']['type']=='alert2'||$data['users'][$msg->chat->id]['btn']['type']=='send'||$data['users'][$msg->chat->id]['btn']['type']=='edit'||$data['users'][$msg->chat->id]['btn']['type']=='none'){
$data['users'][$msg->chat->id]['button']['text'] = $data['users'][$msg->chat->id]['btn']['name'];
$data['users'][$msg->chat->id]['button']['callback_data'] = 'create_'.$data['users'][$msg->chat->id]['code'].'_'.$data['users'][$msg->chat->id]['countbtn'];
}elseif($data['users'][$msg->chat->id]['btn']['type']=='url'){
$data['users'][$msg->chat->id]['button']['text'] = $data['users'][$msg->chat->id]['btn']['name'];
$data['users'][$msg->chat->id]['button']['url'] = $data['users'][$msg->chat->id]['btn']['url'];
}elseif($data['users'][$msg->chat->id]['btn']['type']=='share'){
$data['users'][$msg->chat->id]['button']['text'] = $data['users'][$msg->chat->id]['btn']['name'];
$data['users'][$msg->chat->id]['button']['switch_inline_query'] = $data['users'][$msg->chat->id]['btn']['code'];
}
$data['users'][$msg->chat->id]['buttons'][$data['users'][$msg->chat->id]['btncount']][] = $data['users'][$msg->chat->id]['button'];
$data['code'][$data['users'][$msg->chat->id]['code']]['buttons'][$data['users'][$msg->chat->id]['countbtn']] = $data['users'][$msg->chat->id]['btn'];
$data['users'][$msg->chat->id]['button'] = [];
$data['users'][$msg->chat->id]['btn'] = [];
$data['users'][$msg->chat->id]['command'] = 'new2';
if($data['users'][$msg->chat->id]['lang'] == 'fa'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'ایجاد شد، حالا باید دکمه بعدی رو انتخاب کنی.
اگه میخوای پست رو ایجاد کنی، عبارت /done رو بفرست.',
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'نمایش اخطار']],
[['text'=>'نمایش پیام']],
[['text'=>'بازکردن لینک']],
[['text'=>'ویرایش پیام']],
[['text'=>'دکمه بدون محتوا']],
[['text'=>'پیام به شما']],
[['text'=>'اشتراک گذاری پست']],
[['text'=>'پیشنمایش پست'],['text'=>'اتمام کار']]
],'resize_keyboard'=>true])]);
}
if($data['users'][$msg->chat->id]['lang'] == 'en'){
send('sendMessage',[
'chat_id'=>$msg->chat->id,
'text'=>'Created, Now select your next button.
If you are done, Just send /done .',
'reply_markup'=>json_encode([
'keyboard'=>[
[['text'=>'Show Alert']],
[['text'=>'Show Message']],
[['text'=>'Open URL']],
[['text'=>'Edit Message']],
[['text'=>'Non-media Button']],
[['text'=>'Message to You']],
[['text'=>'Share Post']],
[['text'=>"Post's Preview"],['text'=>'Done']]
],'resize_keyboard'=>true])]);
}
$data['users'][$msg->chat->id]['countbtn']++;
}
}
// by @MSXtm
if(json_encode($data)==true){
file_put_contents($data_ad,json_encode($data));}
flush();
?>
