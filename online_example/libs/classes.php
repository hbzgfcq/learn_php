<?php
class DBFactory{
	static function getDB(){
		global $conf;
		$C=$conf['db']['dbms'];
		$M='getInstance';
		$db=(call_user_func(array($C,$M)));
		return $db;
	}
}

interface IDatabase{
	static function getInstance();
	public function getRows($sql);
	public function getRow($sql);
	public function getCol($sql);
	public function getField($sql);
}
/*
 * 数据库执行失败则打印出错信息并终止执行
 * 结果集为空则返回NULL值
 * 否则返回行数组
 *
 */
class Mysql implements IDatabase{
	protected static $db=null;
	protected $conn=null;
	
	function db_err($err_msg){
			header("Content-type: text/html; charset=utf-8");
			echo $err_msg;
			exit();
	}
	private function __construct(){
		global $conf;
		extract($conf['db']);
		@ $conn=new mysqli($host,$username,$password,$dbname);
		if($conn->connect_errno)
		{
			$this->db_err('连接数据库失败');
		}
		$conn->query('set names utf8');
		$this->conn=$conn;
	}
	
	static function getInstance(){
		if(is_null(self::$db)){
			self::$db=new self();
		}
			return self::$db;
	}
	
	public function getRows($sql){
		$rows=null;
		if(($result=($this->conn->query($sql)))===false)
		{
			$this->db_err('查询数据库失败');
		}
		else if($result->num_rows)
		{
			$field_cnt = $result -> field_count;
			while($row=$result->fetch_array())
			{
				for($i=0;$i<$field_cnt;$i++)
				{
					$row[$i] = stripslashes($row[$i]);
				}
				$rows[]=$row;
			}
		}
		$result->free();
		return $rows;
	}
	
	public function getRow($sql){
		$row=null;
		if(($result=$this->conn->query($sql))===false)
		{
			$this->db_err('查询数据库失败');
		}
		else if($result->num_rows)
		{
			$row=$result->fetch_array();
			for($i=0;$i<$result->field_count;$i++){
				$row[$i]=stripslashes($row[$i]);
			}
		}
		$result->free();
		return $row;
	}

	public function getCol($sql)
	{
		$col=null;
		if(($result=($this->conn->query($sql)))===false)
		{
			$this->db_err('查询数据库失败');
		}
		else if($result->num_rows)
		{
			while($row=$result->fetch_array())
			{
				$col[]=$row[0];
			}
		}
		$result->free();
		return $col;
	}
	
	public function getField($sql){
		$field=null;
		$row=array();
		if(($result=$this->conn->query($sql))===false)
		{
			$this->db_err('查询数据库失败');
		}
		else if($result->num_rows)
		{
			$field=$result->fetch_array()[0];
			$field=stripslashes($field);
		}
		$result->free();
		return $field;
	}

	public function U($sql)
	{
		if(!$this->conn->query($sql)) $this->db_err('查询数据库失败'.$sql);
	}

	public function C($sql)
	{
		if(!$this->conn->query($sql)) $this->db_err('查询数据库失败'.$sql);
	}

	public function D($sql)
	{
		if(!$this->conn->query($sql)) $this->db_err('查询数据库失败'.$sql);
	}
}