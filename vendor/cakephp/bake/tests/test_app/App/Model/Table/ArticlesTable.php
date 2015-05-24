<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.1.0
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Bake\Test\App\Model\Table;

use Cake\ORM\Table;

/**
 * Article table class
 */
class ArticlesTable extends Table
{
	public function initialize(array $config)
	{
		$this->belongsTo('authors');
		$this->belongsToMany('tags');
		$this->hasMany('ArticlesTags');
	}

	/**
	 * Find published
	 *
	 * @param  Cake\ORM\Query $query The query
	 * @return Cake\ORM\Query
	 */
	public function findPublished($query)
	{
		return $query->where(['published' => 'Y']);
	}

	/**
	 * Example public method
	 *
	 * @return void
	 */
	public function doSomething()
	{
	}

	/**
	 * Example Secondary public method
	 *
	 * @return void
	 */
	public function doSomethingElse()
	{
	}

	/**
	 * Example protected method
	 *
	 * @return void
	 */
	protected function _innerMethod()
	{
	}
}
