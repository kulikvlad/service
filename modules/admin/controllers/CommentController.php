<?php


namespace app\modules\admin\controllers;

use app\models\Comment;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use yii\web\Controller;

Class CommentController extends Controller
{
    public function actionIndex()
    {
        $comments = Comment::find()->all();

        return $this->render('index', ['comments'=>$comments]);
    }

    public function actionDelete($id)
    {
        $comment = Comment::findOne($id);
        if($comment->delete())
        {
            return $this->redirect(['comment/index']);
        }
    }

    public function actionAllow($id)
    {
        $comment = Comment::findOne($id);
        if($comment->allow())
        {
            return $this->redirect(['comment/index']);
        }
    }
    public function actionDisallow($id)
    {
        $comment = Comment::findOne($id);
        if($comment->disAllow())
        {
            return $this->redirect(['comment/index']);
        }
    }
}
