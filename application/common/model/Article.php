<?php
namespace app\common\model;

use think\Model;
use think\Session;

class Article extends Model
{
    protected $insert = ['create_time','author_id'];
    /**
     * 浏览量+1
     */
    public function addReading($id){
        $map['id'] = $id;
        return self::where($map)->setInc('reading');
    }
    /**
     * 评论+1
     */
    public function addComment($id){
        $map['id'] = $id;
        return self::where($map)->setInc('comments');
    }

    /**
     * 文章作者
     * @param $value
     * @return mixed
     */
    protected function setAuthorIdAttr($value)
    {
        return $value ? $value : Session::get('admin_id');
    }
    /**
     * 文章作者
     * @param $value
     * @return mixed
     */
    protected function setAuthorAttr($value)
    {
        return $value ? $value : Session::get('admin_name');
    }

    /**
     * 反转义HTML实体标签
     * @param $value
     * @return string
     */
    protected function setContentAttr($value)
    {
        return htmlspecialchars_decode($value);
    }

    /**
     * 序列化photo图集
     * @param $value
     * @return string
     */
    protected function setPhotoAttr($value)
    {
        return serialize($value);
    }

    /**
     * 反序列化photo图集
     * @param $value
     * @return mixed
     */
    protected function getPhotoAttr($value)
    {
        return unserialize($value);
    }

    /**
     * 创建时间
     * @return bool|string
     */
    protected function setCreateTimeAttr()
    {
        return time();
    }
}