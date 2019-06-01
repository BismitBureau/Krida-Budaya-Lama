<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\testimoni;
use App\slide;
use App\achievement;
use App\Admin;
use App\people;
use App\comment;
use App\NewsPost;
use App\EventPost;
use App\image;
use App\gallery;
use App\homeContent;
use App\Recruitment;
use App\SSO\SSO;
use Hash;
use Response;
use DB;

class KridaControl extends Controller
{
      public function rekrutmentRedirect() {
          return 'Under Construction';
        // return redirect('https://docs.google.com/forms/d/e/1FAIpQLSeAq-vYd-iLCJyOmQ-CwCeKaR8dXk16a657xxa3OSZRGcohng/viewform?c=0&w=1');
      }

    public function home() {
      //  return redirect('admin/login');
	  if($this->isValidPage('home') == false)
        abort(404);
      $data = $this->loadData('home');
      return view('home')->with([
                                  'curpage' => 'home',
                                  'lang' => 'en',
                                  'data' => $data
                                ]);
    }

      public function updateRecruitment(Request $request, $id) {

        $recruitment = Recruitment::find($id);

        $recruitment->orangtua = $request->input('orangtua');
        $recruitment->nomor = $request->input('nomor');
        $recruitment->ttl = $request->input('ttl');
        $recruitment->email = $request->input('email');
        $recruitment->Twitter = $request->input('Twitter');
        $recruitment->Facebook = $request->input('Facebook');
        $recruitment->Instagram = $request->input('Instagram');
        $recruitment->prestasi = $request->input('prestasi');
        $recruitment->seni = $request->input('seni');
        $recruitment->date = date("Y/m/d");
        $recruitment->alasan = $request->input('alasan');
        $recruitment->Line = $request->input('Line');
        $recruitment->alamat = $request->input('alamat');

        session_start();

        if ($recruitment->save())  {
          $_SESSION["recruitmentStatus"] = true;
        }

        return redirect('/recruitment');
      }

      public function disableAccess($any) {
      	abort(404);
      }

      public function search(Request $request, $lang) {
      	    $text = $request->input('input');
      	    $news = [];
      	    $event = [];

      	    $words = explode(" ", $text);
      	    foreach($words as $lol) {
      	    	$word = strtolower($lol);
      	    	$tmp1 = DB::table('news_posts')
      	    	->whereRaw('LOWER(titleid) LIKE "%'.$word.'%" OR LOWER(titleen) LIKE "%'.$word.'%" OR LOWER(contenten) LIKE "%'.$word.'%" OR LOWER(contentid) LIKE "%'.$word.'%"')->get();
      	    	$tmp2 = DB::table('event_posts')
      	    	->whereRaw('LOWER(titleid) LIKE "%'.$word.'%" OR LOWER(titleen) LIKE "%'.$word.'%" OR LOWER(contenten) LIKE "%'.$word.'%" OR LOWER(contentid) LIKE "%'.$word.'%"')->get();
      	    	foreach($tmp1 as $tot)
      	    	    $news[$tot->id] = $tot;
      	    	foreach($tmp2 as $tot)
      	    	    $event[$tot->id] = $tot;
      	    }
      	    return view('search')->with(['lang' => $lang, 'news' => $news, 'event' => $event, 'curpage' => '', 'text' => $text]);
      }
      public function setPrimaryImage($tipe, $tipeid, $id) {
      	if(strcmp($tipe,'news')==0) {
      	    $data = NewsPost::find($tipeid);
      	    $image = image::find($id);
      	    $data->imageURL = $image['imageURL'];
      	    $data->save();
      	    return redirect('admin/newsmanager/edit/'.$tipeid);
      	} else if( strcmp($tipe,'event')==0) {
      	    $data = EventPost::find($tipeid);
      	    $image = image::find($id);
      	    $data->imageURL = $image['imageURL'];
      	    $data->save();
      	    return redirect('admin/eventmanager/edit/'.$tipeid);
      	} else {
      	    $data = gallery::find($tipeid);
      	    $image = image::find($id);
      	    $data->imageURL = $image['imageURL'];
      	    $data->save();
      	    return redirect('admin/galleries/edit/'.$tipeid);
      	}
      }
      public function deleteImage(Request $request, $page, $id) {
	    $data = $request->input('delete_list');
	    foreach($data as $datum) {
	      $imgurl = (image::find($datum));
	      unlink(public_path($imgurl['imageURL']));
	    }
	    image::destroy($request->input('delete_list'));
	    return redirect('admin/'.$page.'/edit/'.$id);
      }

       public function uploadSlide(Request $request){
          if($request->hasFile('file')) {
            $file = $request->file('file');
            $name = 'slide_'.sha1(time().time()).'.'.$file->getClientOriginalExtension();
            $path = public_path().'/images/slides/';
      $file->move($path,$name);
      DB::table('slides')->insert(
            ['imageURL' => '/images/slides/'.$name]
      );
            return Response::json('success', 200);
          } else {
            return Response::json('error', 400);
          }
  }


       public function uploadImage(Request $request, $tipe, $id) {
           if($request->hasFile('file')) {
             $file = $request->file('file');
             $name = 'image_'.sha1(time().time()).'.'.$file->getClientOriginalExtension();
             $path = public_path().'/images/upload/';
             $file->move($path,$name);
             if(strcmp($tipe,'news')==0) {
	             DB::table('images')->insert(
	             ['imageURL' => 'images/upload/'.$name, 'news_id' => $id]
	             );
	     } else if (strcmp($tipe,'event')==0) {
	             DB::table('images')->insert(
	             ['imageURL' => 'images/upload/'.$name, 'events_id' => $id]
	             );
	     } else if (strcmp($tipe,'gallery')==0) {
	     	     DB::table('images')->insert(
	     	     ['imageURL' => 'images/upload/'.$name, 'gallery_id' => $id]
	     	     );
	     } else {
             $recruitment = Recruitment::find($id);
             $images = image::where('recruitment_id', $id)->get();
             $delete_list = [];

             foreach($images as $image) {
                array_push($delete_list, $image->id);
                unlink(public_path($image['imageURL']));
             }

             image::destroy($delete_list);

             DB::table('images')->insert(
             ['imageURL' => 'images/upload/'.$name, 'recruitment_id' => $id]
             );

             $recruitment->imageURL = 'images/upload/'.$name;
             $recruitment->save();
             return redirect('/recruitment');
       }
	     return Response::json('success', 200);
           } else
             return Response::json('error', 400);
       }
       public function uploadPeople(Request $request){
          if($request->hasFile('file')) {
            $file = $request->file('file');
            $name = 'people_'.sha1(time().time()).'.'.$file->getClientOriginalExtension();
            $path = public_path().'/images/peoples/';
      $file->move($path,$name);
      DB::table('people')->insert(
            ['photoURL' => '/images/peoples/'.$name]
      );
            return Response::json('success', 200);
          } else {
            return Response::json('error', 400);
          }
  }


  public function uploadTestimoni(Request $request) {
    $names = $request->input('name');
    $contentids = $request->input('contentid');
    $contentens = $request->input('contenten');
    for($i = 0 ; $i < count($names); $i++) {
      if(strlen($names[$i]) != 0 && strlen($contentids[$i]) != 0 && strlen($contentens[$i]) != 0) {
        DB::table('testimonis')->insert(
          ['name' => $names[$i], 'contentid' => $contentids[$i], 'contenten' => $contentens[$i] ]
        );
      }
    }
    return redirect('admin/testimonial');
  }

  public function uploadNews(Request $request) {
    $titleids = $request->input('titleid');
    $titleens = $request->input('titleen');
    for($i = 0 ; $i < count($titleids); $i++) {
      if(strlen($titleids[$i]) != 0 && strlen($titleens[$i]) != 0) {
      	DB::table('news_posts')->insert(
      		['titleid' => $titleids[$i], 'titleen' => $titleens[$i] , 'date' => date("Y-m-d")]
      	);
      }
    }
    return redirect('admin/newsmanager');
  }

  public function uploadEvent(Request $request) {
    $titleids = $request->input('titleid');
    $titleens = $request->input('titleen');
    for($i = 0 ; $i < count($titleids); $i++) {
      if(strlen($titleids[$i]) != 0 && strlen($titleens[$i]) != 0) {
      	DB::table('event_posts')->insert(
      		['titleid' => $titleids[$i], 'titleen' => $titleens[$i] , 'date' => date("Y-m-d")]
      	);
      }
    }
    return redirect('admin/eventmanager');
  }

  public function uploadGallery(Request $request) {
    $titleids = $request->input('titleid');
    $titleens = $request->input('titleen');
    for($i = 0 ; $i < count($titleids); $i++) {
      if(strlen($titleids[$i]) != 0 && strlen($titleens[$i]) != 0) {
      	DB::table('galleries')->insert(
      		['titleid' => $titleids[$i], 'titleen' => $titleens[$i]]
      	);
      }
    }
    return redirect('admin/galleries');
  }

  public function uploadAchievement(Request $request) {
    $years = $request->input('year');
    $stringids = $request->input('stringid');
    $stringens = $request->input('stringen');
    for($i = 0 ; $i < count($years); $i++) {
      if(strlen($years[$i]) != 0 && strlen($stringids[$i]) != 0 && strlen($stringens[$i]) != 0) {
        DB::table('achievements')->insert(
          ['year' => $years[$i], 'stringid' => $stringids[$i], 'stringen' => $stringens[$i] ]
        );
      }
    }
    return redirect('admin/achievements');
  }

  public function uploadComment(Request $request) {
    $name = $request->input('name');
    $email = $request->input('email');
    $website = $request->input('website');
    $content = $request->input('content');
    DB::table('comments')->insert(
      ['name' => $name, 'email' => $email, 'website' => $website, 'content' => $content,'date' => date("Y-m-d"), 'read' => false]
    );
    return redirect('en/comments')->with(['responseen' => 'your form has been submited, thank you', 'responseid' => 'form anda telah kami terima, terima kasih' ]);
  }

  public function deleteAchievement(Request $request) {
    $data = $request->input('delete_list');
    achievement::destroy($data);
    return redirect('admin/achievements');
  }


  public function deleteNews(Request $request) {
    $data = $request->input('delete_list');
    $dataid = [];
    foreach($data as $post) {
    	$images = image::where('news_id',$post)->get();
    	foreach($images as $image) {
    		array_push($dataid,$image['id']);
    		unlink(public_path($image['imageURL']));
    	}
    	NewsPost::destroy($post);
    }
    image::destroy($dataid);
    return redirect('admin/newsmanager');
  }


  public function deleteEvent(Request $request) {
    $data = $request->input('delete_list');
    $dataid = [];
    foreach($data as $post) {
    	$images = image::where('events_id',$post)->get();
    	foreach($images as $image) {
    		array_push($dataid,$image['id']);
    		unlink(public_path($image['imageURL']));
    	}
    	EventPost::destroy($post);
    }
    image::destroy($dataid);
    return redirect('admin/eventmanager');
  }

  public function deleteGallery(Request $request) {
    $data = $request->input('delete_list');
    $dataid = [];
    foreach($data as $post) {
    	$images = image::where('gallery_id',$post)->get();
    	foreach($images as $image) {
    		array_push($dataid,$image['id']);
    		unlink(public_path($image['imageURL']));
    	}
    	gallery::destroy($post);
    }
    image::destroy($dataid);
    return redirect('admin/galleries');
  }




  public function readMessage($id) {
    $message = comment::find($id);
    $data['comments'] = comment::orderBy('id','desc')->get();
    if($message['read'] == false) {
      $message->read = true;
      $message->save();
    }
    return view('readmessage')->with(['message' => $message, 'data' => $data]);
  }

  public function deleteTestimoni(Request $request) {
    $data = $request->input('delete_list');
    testimoni::destroy($data);
    return redirect('admin/testimonial');
  }

  public function deleteComment(Request $request) {
    $data = $request->input('delete_list');
    comment::destroy($data);
    return redirect('admin/message');
  }

  public function deleteSlide(Request $request) {
    $data = $request->input('delete_list');
    if(isset($data)) {
      foreach($data as $datum) {
        $imgurl = (slide::find($datum));
        unlink(public_path($imgurl['imageURL']));
      }
      slide::destroy($request->input('delete_list'));
    }
    return redirect('admin/slider');
  }

  public function deletePeople(Request $request) {
    $data = $request->input('delete_list');
    foreach($data as $datum) {
      $imgurl = (people::find($datum));
      unlink(public_path($imgurl['photoURL']));
    }
    people::destroy($request->input('delete_list'));
    return redirect('admin/peoples');
  }


  public function loadData($curpage) {
    $data['test'] = "OK";
        if(strcmp($curpage,"home")==0) {
          $data["testimonis"] = testimoni::all();
          $data["news"] = NewsPost::limit(4)->orderBy('date','desc')->get(); //slide::all();
          $data["about"] = homeContent::find(1);
        } else if(strcmp($curpage,"achievement")==0) {
          $data["achievements"] = achievement::orderBy('year','desc')->get();
        } else if(strcmp($curpage,"slider")==0) {
          $data["slides"] = slide::all();
        } else if(strcmp($curpage,"testimonial")==0) {
        $data["testimonis"] = testimoni::all();
        } else if(strcmp($curpage,"people")==0) {
          $data["people"] = people::all();
        } else if(strcmp($curpage,"peoples")==0) {
          $data["people"] = people::all();
        } else if (strcmp($curpage,"achievements")==0) {
          $data["achievements"] =  achievement::all();
        } else if (strcmp($curpage,"news")==0) {
          $data["news"] = NewsPost::orderBy('date','desc')->get();
        } else if (strcmp($curpage,"events")==0) {
          $data["events"] = EventPost::orderBy('date','asc')->get();
        } else if (strcmp($curpage,"newsmanager")==0) {
          $data["news"] = NewsPost::orderBy('date','desc')->get();
        } else if (strcmp($curpage,"eventmanager")==0) {
          $data["events"] = EventPost::orderBy('date','desc')->get();
        } else if (strcmp($curpage,"gallery")==0 || strcmp($curpage,"galleries")==0) {
          $data["gallery"] = gallery::orderBy('titleid')->get();
          $data["lsorigin"] = gallery::select('origin')->distinct()->orderBy('origin')->get();
          $data["orig"] = "all";
          $data["images"] = image::all();
        }
    return $data;
  }
    public function editPeople($id) {
      $people = people::find($id);
      $data['comments'] = comment::orderBy('id','desc')->get();
      return view('editpeople')->with(['id' => $id, 'people' => $people, 'data' => $data]);
    }
    public function editNews($id) {
      $news = NewsPost::find($id);
      $data['comments'] = comment::orderBy('id','desc')->get();
      $images = image::where('news_id',$id)->get();
      return view('editnews')->with(['id' => $id, 'news' => $news, 'data' => $data, 'images' => $images]);
    }
    public function editEvent($id) {
      $event = EventPost::find($id);
      $data['comments'] = comment::orderBy('id','desc')->get();
      $images = image::where('events_id',$id)->get();
      return view('editevent')->with(['id' => $id, 'event' => $event, 'data' => $data, 'images' => $images]);
    }

    public function editImage($id) {
      $image = image::find($id);
      $data['comments'] = comment::orderBy('id','desc')->get();
      return view('editimage')->with(['id' => $id, 'image' => $image, 'data' => $data]);
    }

    public function editAbout() {
      $about = homeContent::find(1);
      $data['comments'] = comment::orderBy('id','desc')->get();
      return view('about')->with(['about' => $about, 'data' => $data]);
    }
    public function editGallery($id) {
      $gallery = gallery::find($id);
      $data['comments'] = comment::orderBy('id','desc')->get();
      $images = image::where('gallery_id',$id)->get();
      return view('editgallery')->with(['id' => $id, 'gallery' => $gallery, 'data' => $data, 'images' => $images]);
    }

    public function editAchievement($id) {
      $achievement = achievement::find($id);
      $data['comments'] = comment::orderBy('id','desc')->get();
      return view('editachievement')->with(['id' => $id, 'achievement' => $achievement, 'data' => $data]);
    }
    public function editTestimoni($id) {
      $testimoni = testimoni::find($id);
      $data['comments'] = comment::orderBy('id','desc')->get();
      return view('edittestimoni')->with(['id' => $id, 'testimoni' => $testimoni, 'data' => $data]);
    }

    public function updatePassword(Request $request) {
        $data['comments'] = comment::orderBy('id','desc')->get();

    	$curpass = $request->input('curpass');
    	$newpass = $request->input('newpass');
    	$confirmpass = $request->input('confirmpass');

    	$admin = Admin::find(1);

    	if(Hash::check($curpass,$admin['password'])) {
    		if(strcmp($newpass,$confirmpass) == 0) {
    			$admin->password = Hash::make($newpass);
    			$admin->save();
    			return view('changepassword')->with(['successMessage' => 'Password Changed! '.$newpass.' '.Hash::make($newpass), 'data' => $data]);
    		} else {
    			return view('changepassword')->with(['failMessage' => 'confirm password is incorect!', 'data' => $data]);
    		}
    	} else {
    		return view('changepassword')->with(['failMessage' => 'current password incorect!', 'data' => $data]);
    	}
    }

    public function updatePeople($id, Request $request) {
      $name = $request->input('name');
      $subname = $request->input('subname');
      $contentid = $request->input('contentid');
      $contenten = $request->input('contenten');
      $twitterURL = $request->input('twitterURL');
      $facebookURL = $request->input('facebookURL');
      $instagramURL = $request->input('instagramURL');

      $data = people::find($id);
      $data->name = $name;
      $data->subname = $subname;
      $data->contentid = $contentid;
      $data->contenten = $contenten;
      $data->twitterURL = $twitterURL;
      $data->facebookURL = $facebookURL;
      $data->instagramURL = $instagramURL;

      $data->save();
      return redirect('admin/peoples');
    }

    public function updateAchievement($id, Request $request) {
      $year = $request->input('year');
      $stringid = $request->input('stringid');
      $stringen = $request->input('stringen');

      $data = achievement::find($id);
      $data->year = $year;
      $data->stringid = $stringid;
      $data->stringen = $stringen;

      $data->save();
      return redirect('admin/achievements');
    }

    public function updateNews(Request $request, $id) {
    	$titleid = $request->input('titleid');
    	$titleen = $request->input('titleen');
    	$contentid = $request->input('contentid');
    	$contenten = $request->input('contenten');
    	$snippetid = substr(strip_tags(preg_replace("/\r|\n/", "", $contentid)), 0, min(255,strlen(strip_tags(preg_replace("/\r|\n/", "", $contentid)))));
    	$snippeten = substr(strip_tags(preg_replace("/\r|\n/", "", $contenten)), 0, min(255,strlen(strip_tags(preg_replace("/\r|\n/", "", $contenten)))));
    	$date = $request->input('date');

    	$data = NewsPost::find($id);
    	$data->titleid = $titleid;
    	$data->titleen = $titleen;
    	$data->contentid = $contentid;
    	$data->contenten = $contenten;
    	$data->snippetid = $snippetid;
    	$data->snippeten = $snippeten;
    	$data->date = $date;

    	$data->save();

    	return redirect('admin/newsmanager');
    }

    public function updateEvent(Request $request, $id) {
    	$titleid = $request->input('titleid');
    	$titleen = $request->input('titleen');
    	$contentid = $request->input('contentid');
    	$contenten = $request->input('contenten');
      $snippetid = substr(strip_tags(preg_replace("/\r|\n/", "", $contentid)), 0, min(255,strlen(strip_tags(preg_replace("/\r|\n/", "", $contentid)))));
      $snippeten = substr(strip_tags(preg_replace("/\r|\n/", "", $contenten)), 0, min(255,strlen(strip_tags(preg_replace("/\r|\n/", "", $contenten)))));
    	$date = $request->input('date');
    	$lat = $request->input('LAT');
    	$lng = $request->input('LNG');
    	$location = $request->input('location');

    	$data = EventPost::find($id);
    	$data->titleid = $titleid;
    	$data->titleen = $titleen;
    	$data->contentid = $contentid;
    	$data->contenten = $contenten;
    	$data->snippetid = $snippetid;
    	$data->snippeten = $snippeten;
    	$data->date = $date;
    	$data->lat = $lat;
    	$data->lng = $lng;
    	$data->location = $location;

    	$data->save();

    	return redirect('admin/eventmanager');
    }

    public function updateGallery(Request $request, $id) {
    	$titleid = $request->input('titleid');
    	$titleen = $request->input('titleen');
    	$contentid = $request->input('contentid');
    	$contenten = $request->input('contenten');

    	$data = gallery::find($id);
    	$data->titleid = $titleid;
    	$data->titleen = $titleen;
    	$data->descriptionid = $contentid;
    	$data->descriptionen = $contenten;

    	$data->save();

    	return redirect('admin/galleries');
    }

    public function updateImage(Request $request, $id) {
    	$descriptionid = $request->input('descriptionid');
    	$descriptionen = $request->input('descriptionen');

    	$data = image::find($id);
    	$galleryid = $data['gallery_id'];
    	$data->descriptionid = $descriptionid;
    	$data->descriptionen = $descriptionen;

    	$data->save();
    	return redirect('admin/galleries/edit/'.$galleryid);
    }

    public function updateAbout(Request $request) {
    	$aboutid = $request->input('id');
    	$abouten = $request->input('en');

    	$data = homeContent::find(1);
    	$data->aboutid = $aboutid;
    	$data->abouten = $abouten;

    	$data->save();
    	return redirect('admin/about');
    }

    public function updateTestimoni($id, Request $request) {
      $name = $request->input('name');
      $contenten = $request->input('contenten');
      $contentid = $request->input('contentid');

      $data = testimoni::find($id);
      $data->name = $name;
      $data->contenten = $contenten;
      $data->contentid = $contentid;

      $data->save();
      return redirect('admin/testimonial');
    }

    public function getPage($lang,$curpage) {
      if($this->isValidPage($curpage) == false)
        abort(404);
      $data = $this->loadData($curpage);
      return view($curpage)->with([
                                  'curpage' => $curpage,
                                  'lang' => $lang,
                                  'data' => $data,
                                  'mobilemode' => 'false'
                                ]);
    }

    public function getMobilePage($lang,$curpage) {
      if($this->isValidPage($curpage) == false)
        abort(404);
      $data = $this->loadData($curpage);
      return view('m'.$curpage)->with([
                                  'curpage' => $curpage,
                                  'lang' => $lang,
                                  'data' => $data,
                                  'mobilemode' => 'true'
                                ]);
  }
    public function isValidPage($curpage) {
      if(strcmp($curpage,'home') == 0 || strcmp($curpage,'news') == 0 || strcmp($curpage,'events') == 0 || strcmp($curpage,'people') == 0 || strcmp($curpage,'achievement') == 0 || strcmp($curpage,'gallery') == 0 || strcmp($curpage,'comments') == 0)
        return true;
      return false;
    }

    public function login() {
        session_start();
        $data = $_POST;
        $admin = DB::table('admins')->where('name', $data['name'])->get();
        $hashedPassword = Admin::find($data);

        return $admin;

      if(count($admin) > 0) {
        $_SESSION['name'] = $data['name'];
        $_SESSION['lastlogin'] = date("Y/m/d");
        return redirect('admin/dashboard');
      } else {
        return redirect('admin/login');
      }
    }

    public function loginPage() {
      return view('login');
    }

    public function viewRecruitment($id) {
      $recruitment = Recruitment::find($id);
      $data = $this->loadData('dashboard');
      $data['comments'] = comment::orderBy('id','desc')->get();
      return view('view_recruitment')->with(['recruitment' => $recruitment, 'data' => $data]);
    }

    public function getAdmin($curpage, Request $request) {
      session_start();
      if(!isset($_SESSION['name']) || !isset($_SESSION['lastlogin'])) {
        session_unset();
        session_destroy();
        return redirect('admin/login');
      } else {
      	$now = date("Y/m/d");
      	if(strcmp($now, $_SESSION['lastlogin']) != 0) {
      		session_unset();
      		session_destroy();
      		return redirect('admin/login');
      	}

        $data = $this->loadData($curpage);
        $data['comments'] = comment::orderBy('id','desc')->get();

        if(strcmp($curpage,"dashboard") == 0) {
          if($request->has('recruitmentMode')) {
            $tmp = homeContent::find(1);
            $tmp->recruitment = $request->input('recruitmentMode');

            $tmp->save();
          }

          $data['recruitmentMode'] = homeContent::find(1)->recruitment;
          if($request->has('daterange')) {
            $hoho = explode(" - ", $request->input('daterange'));
            $start = date('Y-m-d',strtotime($hoho[0]));
            $end = date('Y-m-d',strtotime($hoho[1]));
            $data['recruitments'] = DB::table('recruitments')->whereBetween('date', [$start, $end])->orderBy('date','desc')->get();
          } else
            $data['recruitments'] = Recruitment::orderBy('date','desc')->get();
        }
        return view($curpage)->with(['data' => $data]);
      }
    }

    public function setStatusRecruitment($status, $id) {
      $form = Recruitment::find($id);

      $form->status = $status;
      $form->save();

      return redirect('admin/dashboard/viewform/'.$id);
    }

    public function logout() {
      session_start();
      session_unset();
      session_destroy();
      return redirect('admin/login');
    }
    public function eventsPost($lang, $id) {
      return view('eventpost')->with(['lang' => $lang, 'curpage' => 'events', 'data' => $this->loadData('events'), 'event' => EventPost::find($id), 'images' => image::where('events_id',$id)->get()]);
    }

    public function buildGallery($lang, $orig) {
      if($this->isValidPage('gallery') == false)
        abort(404);
      $data = $this->loadData('gallery');
      $data['orig'] = $orig;
      return view('gallery')->with([
                                  'curpage' => 'gallery',
                                  'lang' => $lang,
                                  'data' => $data
                                ]);
    }

    public function newsPost($lang, $id) {
      return view('newspost')->with(['lang' => $lang, 'curpage' => 'news', 'data' => $this->loadData('news'), 'news' => NewsPost::find($id), 'images' => image::where('news_id',$id)->get()]);
    }
    public function eventsPostm($lang, $id) {
      return view('eventpost')->with(['lang' => $lang, 'curpage' => 'events', 'mobilemode' => 'true', 'data' => $this->loadData('events'), 'event' => EventPost::find($id), 'images' => image::where('events_id',$id)->get()]);
    }
    public function newsPostm($lang, $id) {
      return view('mnewspost')->with(['lang' => $lang, 'curpage' => 'news', 'mobilemode' => 'true', 'data' => $this->loadData('news'), 'news' => NewsPost::find($id), 'images' => image::where('news_id',$id)->get()]);
    }
}
