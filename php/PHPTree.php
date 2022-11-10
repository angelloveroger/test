<?php

/**
 * @name PHPTree 
 * @des PHP生成树形结构,无限级分类
 */
class PHPTree
{

	protected static $config = array(
		/* 主键 */
		'primary_key' 	=> 'id',
		/* 父键 */
		'parent_key'  	=> 'parent_id',
		/* 展开属性 */
		'expanded_key'  => 'expanded',
		/* 叶子节点属性 */
		'leaf_key'      => 'leaf',
		/* 孩子节点属性 */
		'children_key'  => 'children',
		/* 是否展开子节点 */
		'expanded'    	=> false
	);

	/* 结果集 */
	protected static $result = array();

	/* 层次暂存 */
	protected static $level = array();
	/**
	 * @name 生成树形结构
	 * @param array 二维数组
	 * @return mixed 多维数组
	 */
	public static function makeTree($data, $options = array(), $top = 0)
	{
		$dataset = self::buildData($data, $options);
		$r = self::makeTreeCore($top, $dataset, 'normal');
		return $r;
	}

	/* 生成线性结构, 便于HTML输出, 参数同上 */
	public static function makeTreeForHtml($data, $options = array())
	{

		$dataset = self::buildData($data, $options);
		$r = self::makeTreeCore(0, $dataset, 'linear');
		return $r;
	}

	/* 格式化数据, 私有方法 */
	private static function buildData($data, $options)
	{
		$config = array_merge(self::$config, $options);
		self::$config = $config;
		extract($config);

		$r = array();
		foreach ($data as $item) {
			$id = $item[$primary_key];
			$parent_id = $item[$parent_key];
			$r[$parent_id][$id] = $item;
		}
		echo '<pre>';print_r($r);
		return $r;
	}

	/* 生成树核心, 私有方法  */
	private static function makeTreeCore($index, $data, $type = 'linear')
	{
		extract(self::$config);
		//echo '<pre>';print_r(self::$config);
		foreach ($data[$index] as $id => $item) {
			if ($type == 'normal') {
				if (isset($data[$id])) {
					//$item[$expanded_key]= self::$config['expanded'];
					$item[$children_key] = self::makeTreeCore($id, $data, $type);
				} else {
					//$item[$leaf_key]= true;  
				}
				$r[] = $item;
			} else if ($type == 'linear') {
				$parent_id = $item[$parent_key];
				self::$level[$id] = $index == 0 ? 0 : self::$level[$parent_id] + 1;
				$item['level'] = self::$level[$id];
				self::$result[] = $item;
				if (isset($data[$id])) {
					self::makeTreeCore($id, $data, $type);
				}

				$r = self::$result;
			}
		}
		//echo '<pre>';print_r($r);
		return $r;
	}
}

/*   测试数据 */
$data = array(
	array(
		'id' => 1,
		'text' => '用户管理',
		'parent_id' => 0
	),
	array(
		'id' => 2,
		'text' => '用户列表',
		'parent_id' => 1
	),
	array(
		'id' => 3,
		'text' => '权限管理',
		'parent_id' => 1
	),
	array(
		'id' => 4,
		'text' => '文章管理',
		'parent_id' => 0
	),
	array(
		'id' => 5,
		'text' => '新闻',
		'parent_id' => 4
	),
	array(
		'id' => 6,
		'text' => '国内新闻',
		'parent_id' => 5
	)
);

$config = array(
	/* 主键 */
	'primary_key' 	=> 'id',
	/* 父键 */
	'parent_key'  	=> 'parent_id',
	/* 展开属性 */
	'expanded_key'  => 'expanded',
	/* 叶子节点属性 */
	'leaf_key'      => 'leaf',
	/* 孩子节点属性 */
	'children_key'  => 'children',
	/* 是否展开子节点 */
	'expanded'    	=> false
);

$r = PHPTree::makeTree($data, $config);

echo '<pre>';
print_r($r);
