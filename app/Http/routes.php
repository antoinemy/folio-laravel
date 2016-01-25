<?php

// Sites Routes

Route::get('/', ['as' => 'site.index', 'uses' => 'HomeController@index']);
Route::get('/articles', ['as' => 'site.articles', 'uses' => 'HomeController@articles']);
Route::get('/categories/{id}/articles', ['as' => 'site.category_articles', 'uses' => 'HomeController@category_articles']);
Route::get('/articles/{id}', ['as' => 'site.page_article', 'uses' => 'HomeController@page_article']);
Route::get('/projects', ['as' => 'site.projects', 'uses' => 'HomeController@projects']);
Route::get('/categories/{id}/projects', ['as' => 'site.category_projects', 'uses' => 'HomeController@category_projects']);
Route::get('/projects/{id}', ['as' => 'site.page_project', 'uses' => 'HomeController@page_project']);

// Authentication Routes
Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function()
{
	// Admin
	Route::get('login', ['as' => 'login', 'uses' => 'AuthController@getLogin']);
	Route::post('login', ['as' => 'post_login', 'uses' => 'AuthController@postLogin']);
	Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@getLogout']);
});

// Administrations Routes
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function()
{
	// Dashboard

	Route::resource('dashboard', 'DashboardController', ['only' => ['index']]);

	// Admins
	Route::resource('admin', 'AdminController', ['except' => ['show']]);

	// Articles
	Route::resource('article', 'ArticleController', ['except' => ['show']]);

	// Articles Categories
	Route::get('category/article', ['as' => 'admin.category_article.index', 'uses' => 'ArticleCategoryController@index']);
	Route::get('category/article/create', ['as' => 'admin.category_article.create', 'uses' => 'ArticleCategoryController@create']);
	Route::post('category/article/store', ['as' => 'admin.category_article.store', 'uses' => 'ArticleCategoryController@store']);
	Route::get('category/article/{id}/edit', ['as' => 'admin.category_article.edit', 'uses' => 'ArticleCategoryController@edit']);
	Route::put('category/article/{id}/update', ['as' => 'admin.category_article.update', 'uses' => 'ArticleCategoryController@update']);
	Route::delete('category/article/{id}/destroy', ['as' => 'admin.category_article.destroy', 'uses' => 'ArticleCategoryController@destroy']);

	// Projets
	Route::resource('project', 'ProjectController', ['except' => ['show']]);

	// Projects Categories
	Route::get('category/project', ['as' => 'admin.category_project.index', 'uses' => 'ProjectCategoryController@index']);
	Route::get('category/project/create', ['as' => 'admin.category_project.create', 'uses' => 'ProjectCategoryController@create']);
	Route::post('category/project/store', ['as' => 'admin.category_project.store', 'uses' => 'ProjectCategoryController@store']);
	Route::get('category/project/{id}/edit', ['as' => 'admin.category_project.edit', 'uses' => 'ProjectCategoryController@edit']);
	Route::put('category/project/{id}/update', ['as' => 'admin.category_project.update', 'uses' => 'ProjectCategoryController@update']);
	Route::delete('category/project/{id}/destroy', ['as' => 'admin.category_project.destroy', 'uses' => 'ProjectCategoryController@destroy']);

	// Pages
	Route::resource('page', 'PageController', ['except' => ['show']]);
});

// Tools Routes
Route::group(['namespace' => 'Tools'], function()
{
	// Images
	Route::get('images/admin/{id}/small/{name}', ['as' => 'admin_image_small', 'uses' => 'ImageController@admin_small']);

	Route::get('images/page/{id}/small/{name}', ['as' => 'page_image_small', 'uses' => 'ImageController@page_small']);
	Route::get('images/page/{id}/{name}', ['as' => 'page_image_normal', 'uses' => 'ImageController@page_normal']);

	Route::get('images/article/{id}/small/{name}', ['as' => 'article_image_small', 'uses' => 'ImageController@article_small']);
	Route::get('images/article/{id}/{name}', ['as' => 'article_image_normal', 'uses' => 'ImageController@article_normal']);

	Route::get('images/project/{id}/small/{name}', ['as' => 'project_image_small', 'uses' => 'ImageController@project_small']);
	Route::get('images/project/{id}/{name}', ['as' => 'project_image_normal', 'uses' => 'ImageController@project_normal']);
});
