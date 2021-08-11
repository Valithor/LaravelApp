<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alaouy\Youtube\Facades\Youtube;
use Session;

class RandomYoutubeVideoComment extends Controller
{

    public function index()
    {           
        return view('randomYoutubeVideoComment.form');
    }

    public function store(Request $request)
    {
        $data= $request->all();
        if(!empty(Session::get('comments')) && !array_key_exists('url',$data)) {
            $comments=Session::get('comments');
            $randIndex = array_rand($comments);
            $randComment= $comments[$randIndex];
        }
        else{
            if(!empty($data['url'])){
                $url=$data['url'];
                $videoId= Youtube::parseVIdFromURL($url);
                $videoData=Youtube::getCommentThreadsByVideoId($videoId, 100, null, ['snippet'], $pageInfo=true);
                
                if(empty($videoData)){
                    $msg="Film nie ma komentarzy";
                    return view('randomYoutubeVideoComment.form')->with('msg',$msg);
                }
                else{
                    $comments = collect([]);
                    foreach($videoData['results'] as $videoComment){
                        $comments->push([
                            'author'=>$videoComment->snippet->topLevelComment->snippet->authorDisplayName,  
                            'authorLink'=>$videoComment->snippet->topLevelComment->snippet->authorChannelUrl,                
                            'comment'=>$videoComment->snippet->topLevelComment->snippet->textDisplay,
                            'img'=>$videoComment->snippet->topLevelComment->snippet->authorProfileImageUrl,
                            // 'likes'=>$videoComment->snippet->topLevelComment->snippet->likeCount,
                        ]);
                    }

                    $nextPageToken=$videoData['info']['nextPageToken'];
                    
                    while($nextPageToken){
                        $token=$nextPageToken;
                        $videoData= Youtube::getCommentThreadsByVideoId($videoId, 100, null, ['snippet'], $pageInfo=true, $pageToken=$token);
                        $nextPageToken=$videoData['info']['nextPageToken'];
                        foreach($videoData['results'] as $videoComment){
                            $comments->push([
                                'author'=>$videoComment->snippet->topLevelComment->snippet->authorDisplayName,  
                                'authorLink'=>$videoComment->snippet->topLevelComment->snippet->authorChannelUrl,                
                                'comment'=>$videoComment->snippet->topLevelComment->snippet->textDisplay,
                                'img'=>$videoComment->snippet->topLevelComment->snippet->authorProfileImageUrl,
                                // 'likes'=>$videoComment->snippet->topLevelComment->snippet->likeCount,
                            ]);
                        }
                    }
               
                    $comments=$comments->toArray(); 
                    //contains specify word
                    if($data['text']!=null && array_key_exists('hasText',$data)){
                        $index=0;
                        $text= $data['text'];    
                        $tmp=array_column($comments, 'comment');
                        foreach($tmp as $comment){
                            // if (!preg_match("/\b{$text}\b/",$comment)) {   //wybiera tylko słowa ale ma prbolem z #  
                            if (!(mb_strpos($comment, $text) !== false)) { 
                                unset($tmp[$index]);                                
                            }
                            $index++;                           
                        }     
                        $comments= array_intersect_key($comments, $tmp);               
                    }       

                     //unique comment author
                     if(array_key_exists('uniqueUser',$data) ){
                        $tmp= array_unique(array_column($comments, 'author'));                       
                        $comments= array_intersect_key($comments, $tmp);
                    }                                          
                              
                    
                    if(empty($comments)){
                        $msg="Brak pasujących komentarzy";
                        return view('randomYoutubeVideoComment.form', compact('msg','url'));
                    }
                    else{
                        Session::forget('comments');
                        Session::put('comments', $comments);    
                        $randIndex = array_rand($comments);
                        $randComment= $comments[$randIndex];                       
                    }
                }
            }
            else{
                return view('randomYoutubeVideoComment.form');
            }
        }
        return view('randomYoutubeVideoComment.result',compact('randComment'));
    }
   
}
