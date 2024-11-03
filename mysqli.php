<?php
/*
Автор: ШОЛОХАНОВ АЛИМЖАН
Mail: a.alim98@mail.ru
*/
class DataBase{
	public $count_sql = 0;
	public $query = false;
	public $mysqli = false;
	
public function connect($DBHOST, $DBUSER, $DBPASS, $DBNAME){
		$this->mysqli = new mysqli($DBHOST, $DBUSER, $DBPASS, $DBNAME);
		$this->mysqli->set_charset("utf8"); 
		if($this->mysqli->connect_error) die($this->mysqli->connect_error);
	}
	
	public function query($query){
		if(!$this->mysqli) $this->connect();
		if(!$this->query = $this->mysqli->query($query)) die($this->mysqli->error);
		$this->count_sql++;
		return $this->query;
	}
	
	public function get_row($query){
		if(!$this->mysqli) $this->connect();
		return $query->fetch_assoc();
	}
	
	public function get_row_query($query){
		if(!$this->mysqli) $this->connect();
		if(!$result = $this->mysqli->query($query)) die($this->mysqli->error);
		$this->count_sql++;
		return $result->fetch_assoc();
	}
	
	public function get_num_rows($query){
		if(!$this->mysqli) $this->connect();
		return $query->num_rows;
	}
	
	public function safe_sql($sql){
		if(!$this->mysqli) $this->connect();
		return $this->mysqli->real_escape_string($sql);
	}
	
	public function version(){
		if(!$this->mysqli) $this->connect();
		return $this->mysqli->server_info;
	}
	
	public function close(){
		if($this->mysqli) $this->mysqli->close();
	}
public function INSERT($zikarr, $tbname) {
                $zik='';
                $zikval='';
                $kl=1;
                foreach($zikarr as $key=> $value) {
                        $ilif=count($zikarr) - 1;
                        if ($kl > $ilif) {
                                $zik.="$key";
                                $zikval.="'$value'";
                        } else {
                                $zik.="$key,";
                                $zikval.="'$value',";
                        }++$kl;
                }
                $sql="INSERT INTO ".$tbname." (".$zik.") VALUES (".$zikval.")";
                $this->query($sql);
                return $this->mysqli->insert_id;
        }
        public function delet($zikarr, $tbname) {
                if (count($zikarr) != 0) {
                        $zikval='';
                        $kl=1;
                        foreach($zikarr as $key=> $value) {
                                $ilif=count($zikarr) - 1;
                                if ($kl > $ilif) {
                                        $zikval.="$key='$value'";
                                } else {
                                        $zikval.="$key='$value' AND ";
                                }++$kl;
                        }
                        $s=$this->query("delete from ".$tbname." where $zikval");
                        return $s;
                } else {
                        return false;
                }
        }
        public function UPDATE($zikarr, $tbname, $scresh) {
                if (count($zikarr) != 0 AND count($scresh) != 0) {
                        $zikval='';
                        $kl=1;
                        foreach($zikarr as $key=> $value) {
                                $ilif=count($zikarr) - 1;
                                if ($kl > $ilif) {
                                        $zikval.="$key='$value'";
                                } else {
                                        $zikval.="$key='$value', ";
                                }++$kl;
                        }
                        unset($value);
                        unset($value);
                        $zikval2='';
                        $kl2=1;
                        foreach($scresh as $key=> $value) {
                                $ilif2=count($scresh) - 1;
                                if ($kl2 > $ilif2) {
                                        $zikval2.="$key='$value'";
                                } else {
                                        $zikval2.="$key='$value' AND ";
                                }++$kl2;
                        }
                        $s=$this->query("UPDATE $tbname SET $zikval where $zikval2");
                        return $s;
                } else {
                        return false;
                }
        }
		public function SELECT($zikarr, $tbname,$or=''){
                if (count($zikarr) != 0) {
                        $zikval='';
                        $kl=1;
                        foreach($zikarr as $key=> $value) {
                                $ilif=count($zikarr) - 1;
                                if ($kl > $ilif) {
                                        $zikval.="$key='$value'";
                                } else {
                                        $zikval.="$key='$value' AND ";
                                }++$kl;
                        }
                        $s=$this->get_row_query("SELECT * from ".$tbname." where $zikval $or");
                        return $s;
                } else {
                        return false;
                }			
			
			
		}
}
$app->db= new DataBase();

?>
