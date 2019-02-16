<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use App\Models\Category;

use Auth;

class TopicsController extends Controller
{

    /**
     * ユーザーの登録するかどうかの認証
     * @author kaku
     * @createtime 2019.02.15
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * 話題の一覧表示
     * @author kaku
     * @createtime 2019.02.15
     */
	public function index(Request $request, Topic $topic)
	{
        $topics = $topic->withOrder($request->order)->paginate(20);
		return view('topics.index', compact('topics'));
	}

    /**
     * 話題の詳細
     * @author kaku
     * @createtime 2019.02.15
     */
    public function show(Request $request, Topic $topic)
    {
        // URL 矫正
        if ( ! empty($topic->slug) && $topic->slug != $request->slug) {
            return redirect($topic->link(), 301);
        }

        return view('topics.show', compact('topic'));
    }


    /**
     * 新規投稿
     * @author kaku
     * @createtime 2019.02.16
     */

	public function create(Topic $topic)
	{
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
	}


    /**
     * 保存
     * @author kaku
     * @createtime 2019.02.16
     */

    public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();

        return redirect()->to($topic->link())->with('success', '投稿成功しました！');
    }

    /**
     * 投稿の編集
     * @author kaku
     * @createtime 2019.02.15
     */
	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
	}

    /**
     * 投稿の更新
     * @author kaku
     * @createtime 2019.02.15
     */

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->route('topics.show', $topic->id)->with('success', '更新成功！');
	}

    /**
     * 投稿の削除
     * @author kaku
     * @createtime 2019.02.16
     */

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('success', '削除完了');
	}

    /**
     * 投稿に写真を追加する
     * @author kaku
     * @createtime 2019.02.15
     */
	public function uploadImage(Request $request,ImageUploadHandler $uploader)
    {

        $data = [
            'success'   => false,
            'msg'       => 'アップロードにエラーが発生しました!',
            'file_path' => ''
        ];

        if ($file = $request->upload_file) {
            // 写真の保存をローカルで
            $result = $uploader->save($request->upload_file, 'topics', \Auth::id(), 1024);
            // 保存できる場合
            if ($result) {
                $data['file_path'] = $result['path'];
                $data['msg']       = "上传成功!";
                $data['success']   = true;
            }
        }
        return $data;
    }
}
