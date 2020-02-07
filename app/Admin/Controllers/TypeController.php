<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;

use App\Models\Section;
use App\Models\Category;
use App\Models\Type;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Layout\Content;
use Illuminate\Support\Facades\URL;

class TypeController extends AdminController
{
    public function __construct()
    {
        $this->section = new Section();
        $this->category = new Category();
    }
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '板块类别';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Type);

        $grid->column('id', __('序号'));
        $grid->column('name', __('名称'));
        $grid->column('section_id', __('板块'))->display(function($section_id){
            return Section::find($section_id)->name;
        });
        $grid->column('category_id', __('类别'))->display(function($category_id){
            return Category::find($category_id)->name;
        });

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
        $show = new Show(Type::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('section_id', __('Section id'));
        $show->field('category_id', __('Category id'));
        $show->field('delflag', __('Delflag'));
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
        $form = new Form(new Type);

        $sections = $this->section->pluck('name','id');
        $categories = $this->category->pluck('name','id');

        $form->text('name', __('名称'));
        $form->select('section_id', __('板块'))->options($sections);
        $form->select('category_id', __('类别'))->options($categories);
        $form->switch('delflag', __('删除'));
        //$form->setAction('new');

        return $form;
    }

    public function showTypes(Content $content){
        $types = Type::orderBy('section_id')
                    ->orderBy('category_id')
                    ->get();
        $content->header("类型列表");
        $content->view('typelist', compact('types'));
        return $content;
    }

}
