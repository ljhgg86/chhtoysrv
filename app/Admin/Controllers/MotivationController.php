<?php

namespace App\Admin\Controllers;

use App\Models\Motivation;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MotivationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '经典金句';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Motivation);

        $grid->model()->orderBy('id', 'desc');
        $grid->column('title', __('标题'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Motivation::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('content', __('Content'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Motivation);

        $form->text('title', __('标题'));
        $form->textarea('content', __('内容'))->rows(3);

        return $form;
    }
}
