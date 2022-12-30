<?php
 
Class Ftp {
	private $host;
	private $login;
	private $password;
	private $serverDir;
	private $localDir;
	private $conn;
 
	public function __construct($host, $login, $password, $serverDir, $localDir) {
		$this->host          = $host;
		$this->login     = $login;
		$this->password      = $password;
		$this->serverDir = $serverDir;
		$this->localDir      = $localDir;
	}
 
	public function getFiles($fileType=false) {
		if ($this->connect()) {
			$files  = ftp_nlist($this->conn, $this->serverDir);
			foreach($files as $file) {
				$this->downloadFile($file, $fileType);
			}
		}
		$this->disconnect();
	}
 
	private function disconnect() {
		ftp_close($this->conn);
	}
 
	private function connect() {
		$this->conn  = ftp_connect($this->host);
		return ftp_login($this->conn, $this->login, $this->password);
	}
 
	private function downloadFile($file, $fileType) {
		if ($fileType){
			$prefixLength   = strlen($fileType);
			if (substr($file, -$prefixLength) == $fileType) {
				ftp_get($this->conn, $this->localDir.substr($file, strlen($this->serverDir)), $file, FTP_BINARY);
			}
		}else {
			ftp_get($this->conn, $this->localDir.substr($file, strlen($this->serverDir)), $file, FTP_BINARY);
		}
	}
}
/*
$ftp    = new Ftp("host", "login", "senha", "pastaWeb/", "pastaLocal/");
$ftp->getFiles("php");
*/

?>