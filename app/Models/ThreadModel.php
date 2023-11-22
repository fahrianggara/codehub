<?php

namespace App\Models;

use App\Models\ReplyModel;
use App\Entities\Thread;
use CodeIgniter\Model;
use Tatter\Relations\Traits\ModelTrait;

class ThreadModel extends Model
{
    use ModelTrait;

    protected $table            = 'threads';
    // protected $with             = ['users', 'thread_categories', 'thread_tags', 'replies'];
    protected $returnType       = Thread::class;
    protected $useTimestamps    = true;
    protected $allowedFields    = ['title', 'slug', 'content', 'views', 'status', 'user_id'];
    
    /**
     * Sync related category
     *
     * @param  mixed $thread_id
     * @param  mixed $category_id
     * @return void
     */
    public function syncCategories($thread_id, $category_id)
    {
        $this->db->table('thread_categories')->where('thread_id', $thread_id)->delete();

        $this->db->table('thread_categories')->insert([
            'thread_id' => $thread_id,
            'category_id' => $category_id
        ]);
    }
    
    /**
     * If tag not exist, insert new tag
     *
     * @param  mixed $name
     * @return void
     */
    public function tagNotExist($name)
    {
        $check = $this->db->table('tags')->where('slug', slug($name))->get()->getRow();

        if (!$check) {
            $this->db->table('tags')->insert([
                'name' => $name,
                'slug' => slug($name)
            ]);
        }
    }
    
    /**
     * Sync related tags
     *
     * @param  mixed $thread_id
     * @param  mixed $tags
     * @return void
     */
    public function syncTags($thread_id, $tags)
    {
        $this->db->table('thread_tags')->where('thread_id', $thread_id)->delete();

        $dataTags = [];
        foreach ($tags as $tag) {
            $dataTags[] = [
                'thread_id' => $thread_id,
                'tag_id' => $tag
            ];
        }

        $this->db->table('thread_tags')->insertBatch($dataTags);
    }

    /**
     * Delete likes
     * 
     * @param  mixed $thread
     * @return void
     */
    public function deleteLikes($thread)
    {
        $this->db->table('likes')
            ->where('model_id', $thread->id)
            ->where('model_class', "App\Models\Thread")
            ->delete();
    }

    /**
     * Delete notifications
     * 
     * @param  mixed $thread
     * @return void
     */
    public function deleteNotifications($thread_id)
    {
        $this->db->table("notifications")
            ->where('model_id', $thread_id)
            ->where('model_class', "App\Models\Thread")
            ->delete();
    }

    /**
     * Delete reports
     * 
     * @param  mixed $thread
     * @return void
     */
    public function deleteReports($thread_id)
    {
        $this->db->table("reports")
            ->where('model_id', $thread_id)
            ->where('model_class', "App\Models\Thread")
            ->delete();
    }

    /**
     * Get Likes
     * 
     * @return object
     */
    public function getLikes($id_model, $class_model)
    {
        return $this->db->table('likes')
            ->where('model_id', $id_model)
            ->where('model_class', $class_model)
            ->get()->getResult();
    }

    /**
     * like or unlike thread
     * 
     * @param int $id_model
     * @param string $class_model
     * @return string
     */
    public function likeOrUnlikeThread($id_model, $class_model)
    {
        $likeRecord = $this->db->table('likes')
            ->where('model_id', $id_model)
            ->where('model_class', $class_model)
            ->where('user_id', auth()->id)
            ->get()->getRow();

        if ($likeRecord) {
            $this->db->table('likes')
                ->where('model_id', $id_model)
                ->where('model_class', $class_model)
                ->where('user_id', auth()->id)
                ->delete();

            return "unlike";
        } else {
            $this->db->table('likes')->insert([
                'user_id' => auth()->id,
                'model_id' => $id_model,
                'model_class' => $class_model,
            ]);

            return "like";
        }
    }

    /**
     * Reply main thread
     * 
     * @param object $post
     * @param bool $isSub
     */
    public function reply($post, $isSub = false)
    {
        $replyModel = new ReplyModel();
        
        $replyModel->save([
            'content' => $post['content'],
            'approved' => 1,
            'thread_id' => base64_decode($post['thread_id']),
            'user_id' => auth()->id,
            'parent_id' => $isSub ? $post['parent_id'] : null,
        ]);
    }
}
