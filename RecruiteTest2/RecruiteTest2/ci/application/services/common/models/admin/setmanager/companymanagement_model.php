<?
	class CompanyManagement_model extends CI_Model
	{
	
		function getCompanyList($arg,$type)
    {
			$query = 'SELECT * 
		  						  FROM (SELECT COMP_NM
													 	 	  ,A.COMP_ID
														 	  ,DOMAIN_ID
														 	  ,QNA_MAIL
															  ,SRV_STS
															  ,PRJ_MNG
															  ,CMP_TEL
															  ,CMP_FAX
															  ,ROW_NUMBER() OVER (ORDER BY REG_DT) ROW_NUM
															  ,COUNT(*) OVER() ALL_LIST_COUNT
													  FROM TBL_COMPANY A
													  JOIN TBL_COMPANY_DTL B
													    ON A.COMP_ID = B.COMP_ID
												 WHERE A.DEL_YN = ? ';
			if ($arg[1] != null)
			{
				if ($type =='COMP_ID') $query .= ' AND COMP_ID like ? ';
				if ($type =='COMP_NM') $query .= ' AND COMP_NM like ? ';
				if ($type =='DOMAIN_ID') $query .= ' AND DOMAIN_ID like ? ';
			}											 
		
			$query .= ' ) RTABLE
								  WHERE ROW_NUM >= ? and ROW_NUM <= ?';
			
			if (!$arg[1])
				{
					array_splice($arg,1,1);
				}
			
			return $this->db->query($query , $arg);
    }
    
    function getCompanyDetail($arg)
    {
    	
    	$query = 'SELECT A.COMP_ID
										  ,A.COMP_NM
										  ,A.CMP_NO
										  ,A.DOMAIN_ID
										  ,QNA_MAIL
										  ,SRV_STS
										  ,PRJ_MNG
										  ,B.CRP_NO
										  ,B.CEO_NM
										  ,B.CMP_TEL
										  ,B.CMP_FAX
										  ,B.CMP_ADD
										  ,B.CMP_TP
										  ,B.CMP_GUBUN
										  ,REPLACE(CONVERT(VARCHAR(10),B.REG_DT,121),\'-\',\'/\') REG_DT
										  ,LOGO_IMG1
										  ,LOGO_IMG2
								  FROM TBL_COMPANY A
								  JOIN TBL_COMPANY_DTL B
								    ON A.COMP_ID = B.COMP_ID 
								 WHERE A.COMP_ID = ?
								   AND A.DEL_YN = ?';
    		return $this->db->query($query , $arg);
    }
    
    function getManagerList($arg)
    {
    	$query = 'SELECT A.MANAGER_ID
										  ,A.MANAGER_NM
										  ,A.USE_YN
										  ,A.AGREEMENT_DT
										  ,A.PSTN
										  ,A.DEPT	  
										  ,A.MOBILE
										  ,A.EMAIL
										  ,A.USE_YN
										  ,CONVERT(VARCHAR(10),A.REG_DT,121) REG_DT
										  ,B.CD_NM MANAGER_TP
								  FROM TBL_MANAGER A
								  JOIN TBL_CODE B
								    ON A.MANAGER_TP = B.CD_CD
								 WHERE COMP_ID = ?
								   AND A.DEL_YN = ?
								   AND B.CD_GB = \'ADM\' 
								   AND B.DEL_YN = \'N\'
								   AND B.USE_YN = \'Y\'';
    	return $this->db->query($query , $arg);
    }
    
    // 데이터 수정
    function CompanyUpdateInfoBase($arg)
    {
    	$query = 'UPDATE TBL_COMPANY SET
										   COMP_NM = ?,
										   CMP_NO = ?,
										   QNA_MAIL = ?,
										   SRV_STS = ?,
										   PRJ_MNG = ?
								 WHERE COMP_ID = ?';
			return $this->db->query($query , $arg);
		}
		
		function CompanyUpdateInfoDetail($arg)
		{
			$query = 'UPDATE TBL_COMPANY_DTL SET
										   CRP_NO = ?,
										   CEO_NM = ?,
										   CMP_TEL = ?,
										   CMP_FAX = ?,
										   CMP_ADD = ?,
										   CMP_TP = ?,
										   CMP_GUBUN = ?,
										   LOGO_IMG1 = ?,
										   LOGO_IMG2 = ?
								 WHERE COMP_ID = ?';
			return $this->db->query($query , $arg);
    }
    
    // 데이터 등록
    function CompanyInsertInfoBase($arg)
    {
    	$query = 'INSERT INTO 
    					  TBL_COMPANY (COMP_ID,
    					  						 COMP_NM,
    					  						 CMP_NO,
    					  						 DOMAIN_ID,
    					  						 QNA_MAIL,
    					  						 SRV_STS,
    					  						 PRJ_MNG)
    					  	   VALUES (?,?,?,?,?,?,?)';
		 	return $this->db->query($query , $arg);
    }
    
    function CompanyInsertInfoDetail($arg)
    {
    	$query = 'INSERT INTO 
    					  TBL_COMPANY_DTL (COMP_ID,
    					  						 CRP_NO,
    					  						 CEO_NM,
    					  						 CMP_TEL,
    					  						 CMP_FAX,
    					  						 CMP_ADD,
    					  						 CMP_TP,
    					  						 CMP_GUBUN,
    					  						 REG_DT,
    					  						 LOGO_IMG1,
    					  						 LOGO_IMG2)
    					  	   VALUES (?,?,?,?,?,?,?,?,getdate(),?,?)';
		 	return $this->db->query($query , $arg);
    }
    
    function checkCompanyId($arg)
    {
    	$query = 'SELECT COMP_ID 
    							FROM TBL_COMPANY 
    						 WHERE COMP_ID = ?';
    	return $this->db->query($query , $arg);
    }
    
    function checkDomainId($arg)
    {
    	$query = 'SELECT DOMAIN_ID 
    							FROM TBL_COMPANY 
    						 WHERE DOMAIN_ID = ?';
    	return $this->db->query($query , $arg);
    }
    
	}
