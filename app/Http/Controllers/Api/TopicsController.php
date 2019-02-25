<?php

namespace App\Http\Controllers\Api;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Transformers\TopicTransformer;
use App\Http\Requests\Api\TopicRequest;
use App\Models\User;


class TopicsController extends Controller
{

    /**
     *
     * @author kaku
     * @since 2019.02.20
     * カテゴリーの一覧リスト
     */

    public function store(TopicRequest $request, Topic $topic)
    {

        $topic->fill($request->all());
        $topic->user_id = $this->user()->id;
        $topic->save();
        return $this->response->item($topic, new TopicTransformer())
            ->setStatusCode(201);

    }

    /**
     *
     * @author kaku
     * @since 2019.02.25
     * 投稿の更新
     */

    public function update(TopicRequest $request, Topic $topic){

        $this->authorize('update', $topic);

        $topic->update($request->all());
        return $this->response->item($topic, new TopicTransformer());

    }

    /**
     *
     * @author kaku
     * @since 2019.02.20
     * 投稿の削除
     */

    public function destroy(Topic $topic){
        $this->authorize('destroy',$topic);

        $topic->delete();

        return $this->response->noContent();

    }


    /**
     *
     * @author kaku
     * @since 2019.02.25
     * 投稿の一覧
     */

    public function index(Request $request,Topic $topic)
    {
        $query=$topic->query();

        if ($categoryId = $request->category_id) {
            $query->where('category_id', $categoryId);
        }

        switch ($request->order) {
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }

        $topics = $query->paginate(20);

        return $this->response->paginator($topics, new TopicTransformer());
    }

    public function userIndex(User $user, Request $request)
    {
        $topics = $user->topics()->recent()
            ->paginate(20);

        return $this->response->paginator($topics, new TopicTransformer());
    }
}
