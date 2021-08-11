<?php

namespace App\Http\Controllers\OutsideApi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

use Youtube;

class YoutubeController extends Controller
{
    public function getVideoComments(Request $request)
    {   
        $data = $request->all();
            
            $video_info = Youtube::getCommentThreadsByVideoId($data['v'],100,null,['snippet'],$pageInfo=True);
            $video = Youtube::getCommentThreadsByVideoId($data['v'],100,null,['snippet']);
            $comments = collect([]);

            $randomize = new \App\Models\Randomizes(['name'=>'Losowanie komentarza']);
            $randomize->save();
    
            foreach($video as $comment){


                $randomize->comments()->save(new \App\Models\Comments(array('author'=>$comment->snippet->topLevelComment->snippet->authorDisplayName,
                    'author_link'=>$comment->snippet->topLevelComment->snippet->authorChannelUrl,
                    'comment'=>$comment->snippet->topLevelComment->snippet->textDisplay,
                    'profile_image'=>$comment->snippet->topLevelComment->snippet->authorProfileImageUrl
                )));

                $comments->push([
                    'author'=>$comment->snippet->topLevelComment->snippet->authorDisplayName,
                    'author_link'=>$comment->snippet->topLevelComment->snippet->authorChannelUrl,
                    'comment'=>$comment->snippet->topLevelComment->snippet->textDisplay,
                    'profile_image'=>$comment->snippet->topLevelComment->snippet->authorProfileImageUrl,
                    ]);
            }

            $video_token = $video_info['info']['nextPageToken'];

            while ($video_token){
                $token = $video_token;
                $video_info = Youtube::getCommentThreadsByVideoId($data['v'],100,null,['snippet'],$pageInfo=True, $pageToken=$token);
                $video = Youtube::getCommentThreadsByVideoId($data['v'],100,null,['snippet'], false, $pageToken=$token);
                $video_token = $video_info['info']['nextPageToken'];

                foreach($video as $comment){

                    $randomize->comments()->save(new \App\Models\Comments(array('author'=>$comment->snippet->topLevelComment->snippet->authorDisplayName,
                    'author_link'=>$comment->snippet->topLevelComment->snippet->authorChannelUrl,
                    'comment'=>$comment->snippet->topLevelComment->snippet->textDisplay,
                    'profile_image'=>$comment->snippet->topLevelComment->snippet->authorProfileImageUrl
                    
                )));

                    $comments->push([
                        'author'=>$comment->snippet->topLevelComment->snippet->authorDisplayName,
                        'author_link'=>$comment->snippet->topLevelComment->snippet->authorChannelUrl,
                        'comment'=>$comment->snippet->topLevelComment->snippet->textDisplay,
                        'profile_image'=>$comment->snippet->topLevelComment->snippet->authorProfileImageUrl,
                        ]);
                        
                }

            }

        return $comments;
    }
    public function showVideoComments()
    {   
        $comments = \App\Models\Comments::all();
        return $comments;
    }
    public function randomizeComment()
    {   
        $comments = \App\Models\Comments::all();
        $randomize_comment = $comments->random();
        return $randomize_comment;
    }

}
