<?php 
/**
 * Models companies
 */
class Company extends model
{
	private $companyInfo;
	
	public function __construct($id) 
    {
        parent::__construct();

    	$sql = $this->db->prepare("SELECT * FROM company WHERE id_company = :id_company");
    	$sql->bindValue(':id_company', $id);
    	$sql->execute();

    	if ($sql->rowCount > 0) {
    		$this->companyInfo = $sql->fetch();
    	}
    }

    public function getName() 
    {
        if (isset($this->companyInfo['name'])) {
            return $this->companyInfo['name'];
        } else {
            return '';
        }
        
    }
}