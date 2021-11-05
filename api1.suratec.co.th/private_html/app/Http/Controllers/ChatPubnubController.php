<?php 
namespace App\Http\Controllers;
use PubNub\PubNub;
use PubNub\Enums\PNStatusCategory;
use PubNub\Callbacks\SubscribeCallback;
use PubNub\PNConfiguration;
use App\ModChat;
use App\Channel;

class ChatPubnubController extends SubscribeCallback 
{
    public function lazyMessageList($channel_id,$timestemp){        
        $channalList = ModChat::where('channel_id',$channel_id)->where('timetoken','>',$timestemp)->take(10)->get();
        return response()->json(['data' => $channalList], 200);
    }
    public function getPubnumMessage(){        
        $pnconf = new PNConfiguration();
        $pubnub = new PubNub($pnconf);
        // $pnconf->setSubscribeKey("sub-c-74d3646e-174a-11eb-bc34-ce6fd967af95");
        // $pnconf->setPublishKey("pub-c-2ea01ae8-7cd3-42ed-a8b4-dc85487d86b6");     
        $pnconf->setSubscribeKey("sub-c-0ed63c0a-3a35-11eb-b6eb-96faa39b9528");
        $pnconf->setPublishKey("pub-c-516c0094-351b-48ca-ace4-2365378c1eaa");     
        $subscribeCallback = new ChatPubnubController();
        $pubnub->addListener($subscribeCallback);   
        $channalList = Channel::get();  
        if($channalList){
            foreach($channalList as $data) {  
                $last = ModChat::where('channel_id',$data->channel_id)->orderBy('id','DESC')->first();
                    if($last){
                        $result =   $pubnub->history()
                        ->channel($data->channel_id)
                        ->count(5000)
                        ->reverse(true)
                        ->includeTimetoken(true)
                        ->start($last->timetoken)
                        ->sync();
                    }else{
                        $result =   $pubnub->history()
                        ->channel($data->channel_id)
                        ->count(5000)
                        ->reverse(true)
                        ->includeTimetoken(true)
                        ->sync();
                    }
                //  print_r($result);die;
                foreach($result->getMessages() as $message) {
                    $content = $message->getEntry();
                    $chat = new ModChat;
                    $chat->url = $content['url'];
                    $chat->sender_id = $content['sender_id'];
                    $chat->channel_id = $content['channel_id'];
                    $chat->timeZone = $content['timeZone'];
                    $chat->msg = $content['msg'];
                    $chat->path = $content['path'];
                    $chat->reciever_id = $content['reciever_id'];
                    $chat->type  = $content['type'];
                    $chat->timetoken = $message->getTimetoken();
                    $chat->save();
                }
            }
        }
       return 1;
    }
    function status($pubnub, $status) {
        if ($status->getCategory() === PNStatusCategory::PNUnexpectedDisconnectCategory) {
            // This event happens when radio / connectivity is lost
        } else if ($status->getCategory() === PNStatusCategory::PNConnectedCategory) {
            // Connect event. You can do stuff like publish, and know you'll get it
            // Or just use the connected event to confirm you are subscribed for
            // UI / internal notifications, etc
        } else if ($status->getCategory() === PNStatusCategory::PNDecryptionErrorCategory) {
            // Handle message decryption error. Probably client configured to
            // encrypt messages and on live data feed it received plain text.
        }
    }

    function message($pubnub, $message) {
        // Handle new message stored in message.message
    }

    function presence($pubnub, $presence) {
        // handle incoming presence data
    }
}