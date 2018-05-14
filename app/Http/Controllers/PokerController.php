<?php namespace App\Http\Controllers;

use Auth;
use App\Traits\Poker;
use App\Traits\Helper;
use Illuminate\Http\Request;

class PokerController extends Controller
{
    use Poker;
    use Helper;

    public function setAvatar(Request $request) {
        $val = $this->val($request, [
            'avatar' => 'between:' . \Config::get('poker.avatarMin') . ',' . \Config::get('poker.avatarMax') . '|required'
        ]);
        if($val) return response()->json($val, 422);
        $user = Auth::user();
        $pmApi = $this->_setAvatar($user->player, $request->input('avatar'));
        if(isset($pmApi->Error)) return response()->json($pmApi->Error, 400);
        return response()->json('Your avatar has been successfully changed.');
    }

    public function setAvatarCustom(Request $request) {
        $user = Auth::user();
        //$image = base64_decode(substr($request->input('customAvatar'), strpos($request->input('customAvatar'), ',') + 1));
        /*        $image = base64_decode($request->input('customAvatar'));
                $avatarPath = Helper::uploadAvatar($image->getRealPath(), $image->guessClientExtension(), $user->steamid);
                if ($avatarPath) {
                    $params['AvatarFile'] = $avatarPath;
                    $params['Avatar'] = 0;
                }
                else $info = '<br>Custom avatar could not be uploaded. Using default one instead.';*/

        //\Image::make($image->getRealPath())->save($path);
        /*        logger([
                    'image' => $image,
                    'path' => public_path()."/img/designs/".$image,
                    '$_FILES' => $_FILES,
                    'all()' => $request->all(),
                    'input()' => $request->input(),
                    'allFiles()' => $request->allFiles(),
                    'input(\'customAvatar\')' => $request->input('customAvatar'),
                    'hasFile(\'customAvatar\')' => $request->hasFile('customAvatar'),
                    'has(\'customAvatar\')' => $request->has('customAvatar'),
                    'file(\'customAvatar\')' => $request->file('customAvatar'),
                ]);*/
        $val = $this->val($request, [
            'customAvatar' => 'image|mimes:gif,png|required'
        ]);
        if($val) return response()->json($val, 422);
        if(!$request->hasFile('customAvatar')) return response()->json('No file found!', 400);

        $file = $request->file('customAvatar');

        $avatarFile = $this::uploadAvatar($file->getRealPath(), $file->guessClientExtension(), $user->steamid);
        if($avatarFile) {
            $api = $this->_setAvatarCustom($user->player, $avatarFile);
            if(isset($api->Error)) return response()->json($api->error, 400);
            return response()->json('Your custom Avatar has been successfully updated!');
        }
        return response()->json('File could not be uploaded. Try again!', 400);
    }

    public function setAvatarCustomNoAjax(Request $request) {
        if(!$request->hasFile('customAvatar')) return redirect()->back()->with('info', 'No file found!', 400);

        $file = $request->file('customAvatar');

        $user = Auth::user();

        $avatarFile = $this::uploadAvatar($file->getRealPath(), $file->guessClientExtension(), $user->steamid);
        if($avatarFile) {
            $api = $this->_setAvatarCustom($user->player, $avatarFile);
            if(isset($api->Error)) return response()->json($api->error, 400);
            return redirect()->back()->with('info', 'Your custom Avatar has been successfully updated!');
        }
        return redirect()->back()->withErrors(['error' => 'File could not be uploaded.']);
    }

    public function setLocation(Request $request) {
        $val = $this->val($request, [
            'location' => 'between:1,30|required|string'
        ]);
        if($val) return response()->json($val, 422);

        $location = $request->input('location');
        $user = Auth::user();
        $pmApi = $this->_setLocation($user->player, $location);
        if(isset($pmApi->error)) return response()->json($pmApi->Error, 400);
        return response()->json('Your location has been successfully updated to ' . e($location) . '.');
    }
}
