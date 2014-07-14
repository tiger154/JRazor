<?
	class Codemanagement_model extends CI_Model
	{
		
		function getCodeList($arg)
		{
			$query = 'SELECT CD_IDX CODE,
										   CD_NM NAME
									  FROM TBL_CODE
									 WHERE CD_GB = ?
									   AND DEL_YN = ?
									   AND USE_YN = ?';
			return $this->db->query($query, $arg);
		}
		
		// 자격증 쿼리들  -------------------------------------------- 
		function getInsertLicense($arg)
		{
			$query = 'INSERT INTO TBL_CODE_LICENSE(LIC_NM,LIC_PB,CD_IDX) VALUES(?,?,?)';
			return $this->db->query($query, $arg);
		}
		
		function getUpdateLicense($arg)
		{
			$query = 'UPDATE TBL_CODE_LICENSE 
									 SET LIC_NM = ?
									    ,LIC_PB = ?
									    ,CD_IDX = ?
								 WHERE LIC_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query, $arg);					   
		}
		
		function getDeleteLicense($arg)
		{
			$query = 'UPDATE TBL_CODE_LICENSE SET DEL_YN = ? WHERE LIC_IDX = ?';
			return $this->db->query($query, $arg);
		}
		
		function getLicenseData($arg)
		{
			$query = 'SELECT LIC_IDX
											,LIC_NM
											,CD_IDX
											,LIC_PB
								  FROM TBL_CODE_LICENSE
								 WHERE LIC_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query, $arg);
		}
		
		function getLicenseList($arg)
		{
			$query = 'SELECT * 
	  						  FROM (SELECT B.LIC_IDX
															,B.CD_IDX
															,A.CD_NM
															,B.LIC_NM
															,B.LIC_PB
															,CONVERT(VARCHAR(10), B.REG_DT , 121) REG_DT
															,ROW_NUMBER() OVER (ORDER BY B.LIC_IDX DESC) ROW_NUM
											  			,COUNT(*) OVER() ALL_LIST_COUNT
							 				    FROM TBL_CODE A
							 				    JOIN TBL_CODE_LICENSE B
							 				      ON A.CD_IDX = B.CD_IDX
							 				   WHERE A.CD_GB = ?';
							 				   
		  if ($arg[1] != '') $query .= ' AND A.CD_IDX = ? ';
		  if ($arg[2] != '') $query .= ' AND B.LIC_NM LIKE ?';
		  $query .= '
							 				     AND A.DEL_YN = ? 
							 				     AND A.USE_YN = ?
							 				   	 AND B.DEL_YN = ?) RTABLE
								  WHERE ROW_NUM >= ? AND ROW_NUM <= ?';
			if (!$arg[1] && !$arg[2]) array_splice($arg,1,2);
			if (!$arg[1] && $arg[2]) array_splice($arg,1,1);
			if ($arg[1] && !$arg[2]) array_splice($arg,2,1);
			
			return $this->db->query($query, $arg);
		}
		
		
		
		
		
		
		//학교 관련 쿼리들
		function getInsertSchool($arg)
		{
			$query = 'INSERT INTO TBL_CODE_SCHOOL(SCH_NM,CD_IDX) VALUES(?,?)';
			return $this->db->query($query, $arg);
		}
		
		function getUpdateSchool($arg)
		{
			$query = 'UPDATE TBL_CODE_SCHOOL 
									 SET SCH_NM = ?
									    ,CD_IDX = ?
								 WHERE SCH_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query, $arg);					   
		}
		
		function getDeleteSchool($arg)
		{
			$query = 'UPDATE TBL_CODE_SCHOOL SET DEL_YN = ? WHERE SCH_IDX = ?';
			return $this->db->query($query, $arg);
		}
		
		function getSchoolData($arg)
		{
			$query = 'SELECT SCH_IDX
											,SCH_NM
											,CD_IDX
								  FROM TBL_CODE_SCHOOL
								 WHERE SCH_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query, $arg);
		}
		
		function getSchoolList($arg)
		{
			$query = 'SELECT * 
	  						  FROM (SELECT B.SCH_IDX
															,B.CD_IDX
															,A.CD_NM
															,B.SCH_NM
															,CONVERT(VARCHAR(10), B.REG_DT , 121) REG_DT
															,ROW_NUMBER() OVER (ORDER BY B.SCH_IDX DESC) ROW_NUM
											  			,COUNT(*) OVER() ALL_LIST_COUNT
							 				    FROM TBL_CODE A
							 				    JOIN TBL_CODE_SCHOOL B
							 				      ON A.CD_IDX = B.CD_IDX
							 				   WHERE A.CD_GB = ?';
							 				   
		  if ($arg[1] != '') $query .= ' AND A.CD_IDX = ? ';
		  if ($arg[2] != '') $query .= ' AND B.SCH_NM LIKE ?';
		  $query .= '
							 				     AND A.DEL_YN = ? 
							 				     AND A.USE_YN = ?
							 				   	 AND B.DEL_YN = ?) RTABLE
								  WHERE ROW_NUM >= ? AND ROW_NUM <= ?';
			if (!$arg[1] && !$arg[2]) array_splice($arg,1,2);
			if (!$arg[1] && $arg[2]) array_splice($arg,1,1);
			if ($arg[1] && !$arg[2]) array_splice($arg,2,1);
			
			return $this->db->query($query, $arg);
		}
		
		
		
		
		//전공 관련 쿼리들
		function getInsertMajor($arg)
		{
			$query = 'INSERT INTO TBL_CODE_MAJOR(MJR_NM,CD_IDX) VALUES(?,?)';
			return $this->db->query($query, $arg);
		}
		
		function getUpdateMajor($arg)
		{
			$query = 'UPDATE TBL_CODE_MAJOR 
									 SET MJR_NM = ?
									    ,CD_IDX = ?
								 WHERE MJR_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query, $arg);					   
		}
		
		function getDeleteMajor($arg)
		{
			$query = 'UPDATE TBL_CODE_MAJOR SET DEL_YN = ? WHERE MJR_IDX = ?';
			return $this->db->query($query, $arg);
		}
		
		function getMajorData($arg)
		{
			$query = 'SELECT MJR_IDX
											,MJR_NM
											,CD_IDX
								  FROM TBL_CODE_MAJOR
								 WHERE MJR_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query, $arg);
		}
		
		function getMajorList($arg)
		{
			$query = 'SELECT * 
	  						  FROM (SELECT B.MJR_IDX
															,B.CD_IDX
															,A.CD_NM
															,B.MJR_NM
															,CONVERT(VARCHAR(10), B.REG_DT , 121) REG_DT
															,ROW_NUMBER() OVER (ORDER BY B.MJR_IDX DESC) ROW_NUM
											  			,COUNT(*) OVER() ALL_LIST_COUNT
							 				    FROM TBL_CODE A
							 				    JOIN TBL_CODE_MAJOR B
							 				      ON A.CD_IDX = B.CD_IDX
							 				   WHERE A.CD_GB = ?';
							 				   
		  if ($arg[1] != '') $query .= ' AND A.CD_IDX = ? ';
		  if ($arg[2] != '') $query .= ' AND B.MJR_NM LIKE ?';
		  $query .= '
							 				     AND A.DEL_YN = ? 
							 				     AND A.USE_YN = ?
							 				   	 AND B.DEL_YN = ?) RTABLE
								  WHERE ROW_NUM >= ? AND ROW_NUM <= ?';
			if (!$arg[1] && !$arg[2]) array_splice($arg,1,2);
			if (!$arg[1] && $arg[2]) array_splice($arg,1,1);
			if ($arg[1] && !$arg[2]) array_splice($arg,2,1);
			
			return $this->db->query($query, $arg);
		}
		
		
		
		// 어학관련 쿼리들  -------------------------------------------- 
		function getInsertLanguage($arg)
		{
			$query = 'INSERT INTO TBL_CODE_LANGUAGE(LAN_NM,LAN_PB,SCORE_TP,CD_IDX) VALUES(?,?,?,?)';
			return $this->db->query($query, $arg);
		}
		
		function getUpdateLanguage($arg)
		{
			$query = 'UPDATE TBL_CODE_LANGUAGE 
									 SET LAN_NM = ?
									    ,LAN_PB = ?
									    ,SCORE_TP = ?
									    ,CD_IDX = ?
								 WHERE LAN_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query, $arg);					   
		}
		
		function getDeleteLanguage($arg)
		{
			$query = 'UPDATE TBL_CODE_LANGUAGE SET DEL_YN = ? WHERE LAN_IDX = ?';
			return $this->db->query($query, $arg);
		}
		
		function getLanguageData($arg)
		{
			$query = 'SELECT LAN_IDX
											,LAN_NM
											,CD_IDX
											,LAN_PB
											,SCORE_TP
								  FROM TBL_CODE_LANGUAGE
								 WHERE LAN_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query, $arg);
		}
		
		function getLanguageList($arg)
		{
		
			$query = 'SELECT * 
	  						  FROM (SELECT B.LAN_IDX
															,B.CD_IDX
															,(SELECT CD_NM FROM TBL_CODE A WHERE A.CD_GB = \'LAN\' AND A.CD_IDX = B.CD_IDX AND A.USE_YN = \'Y\' AND A.DEL_YN =\'N\' ) CD_NM 
															,(SELECT CD_NM FROM TBL_CODE A WHERE A.CD_GB = \'LNT\' AND A.CD_IDX = B.SCORE_TP AND A.USE_YN = \'Y\' AND A.DEL_YN =\'N\' ) SCORE_TP
															,B.LAN_NM
															,B.LAN_PB
															,CONVERT(VARCHAR(10), B.REG_DT , 121) REG_DT
															,ROW_NUMBER() OVER (ORDER BY B.LAN_IDX DESC) ROW_NUM
											  			,COUNT(*) OVER() ALL_LIST_COUNT
							 				    FROM TBL_CODE_LANGUAGE B
							 				   WHERE 1=1 ';
							 				   
		  if ($arg[0] != '') $query .= ' AND B.CD_IDX = ? ';
		  if ($arg[1] != '') $query .= ' AND B.LAN_NM LIKE ?';
		  $query .= '		AND B.DEL_YN = ?) RTABLE
								  WHERE ROW_NUM >= ? AND ROW_NUM <= ?';
			if (!$arg[0] && !$arg[1]) array_splice($arg,0,2);
			if (!$arg[0] && $arg[1]) array_splice($arg,1,1);
			if ($arg[0] && !$arg[1]) array_splice($arg,1,1);
			
			return $this->db->query($query, $arg);
		}
		
		
		
		//근무지  관련 쿼리들
		function getInsertWorkPlace($arg)
		{
			$query = 'INSERT INTO TBL_WORKPLACE(COMP_ID,WRK_PLC_NM) VALUES(?,?)';
			return $this->db->query($query, $arg);
		}
		
		function getUpdateWorkPlace($arg)
		{
			$query = 'UPDATE TBL_WORKPLACE 
									 SET WRK_PLC_NM = ?
								 WHERE COMP_ID = ?
								   AND WP_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query, $arg);					   
		}
		
		function getDeleteWorkPlace($arg)
		{
			$query = 'UPDATE TBL_WORKPLACE SET DEL_YN = ? WHERE COMP_ID = ? AND WP_IDX = ?';
			return $this->db->query($query, $arg);
		}
		
		function getWorkPlaceData($arg)
		{
			$query = 'SELECT WP_IDX
											,WRK_PLC_NM
								  FROM TBL_WORKPLACE
								 WHERE COMP_ID = ?
								   AND WP_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query, $arg);
		}
		
		function getWorkPlaceList($arg)
		{
			$query = 'SELECT * 
	  						  FROM (SELECT WP_IDX
															,WRK_PLC_NM
															,CONVERT(VARCHAR(10), REG_DT , 121) REG_DT
															,ROW_NUMBER() OVER (ORDER BY WP_IDX DESC) ROW_NUM
											  			,COUNT(*) OVER() ALL_LIST_COUNT
							 				    FROM TBL_WORKPLACE
							 				   WHERE COMP_ID = ? ';
		  if ($arg[1] != '') $query .= ' AND WRK_PLC_NM LIKE ?';
		  $query .= 'AND DEL_YN = ?) RTABLE
								  WHERE ROW_NUM >= ? AND ROW_NUM <= ?';
			if (!$arg[1]) array_splice($arg,1,1);
			return $this->db->query($query, $arg);
		}
		
		
		
		//계열 관련 쿼리들
		function getInsertMajorAffiliation($arg)
		{
			$query = 'INSERT INTO TBL_CODE_AFFILIATION(AFF_NM) VALUES(?)';
			return $this->db->query($query, $arg);
		}
		
		function getUpdateMajorAffiliation($arg)
		{
			$query = 'UPDATE TBL_CODE_AFFILIATION 
									 SET AFF_NM = ?
								 WHERE AFF_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query, $arg);					   
		}
		
		function getDeleteMajorAffiliation($arg)
		{
			$query = 'UPDATE TBL_CODE_AFFILIATION SET DEL_YN = ? WHERE AFF_IDX = ?';
			return $this->db->query($query, $arg);
		}
		
		function getMajorAffiliationData($arg)
		{
			$query = 'SELECT AFF_IDX
											,AFF_NM
										
								  FROM TBL_CODE_AFFILIATION
								 WHERE AFF_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query, $arg);
		}
		
		function getMajorAffiliationList($arg)
		{
			$query = 'SELECT * 
	  						  FROM (SELECT B.AFF_IDX
															,B.AFF_NM
															,CONVERT(VARCHAR(10), B.REG_DT , 121) REG_DT
															,ROW_NUMBER() OVER (ORDER BY B.AFF_IDX DESC) ROW_NUM
											  			,COUNT(*) OVER() ALL_LIST_COUNT
							 				    FROM TBL_CODE_AFFILIATION B
							 				   WHERE 1=1';
		  if ($arg[0] != '') $query .= ' AND B.AFF_NM LIKE ?';
		  $query .= '
							 				   	 AND B.DEL_YN = ?) RTABLE
								  WHERE ROW_NUM >= ? AND ROW_NUM <= ?';
			
			if (!$arg[0]) array_splice($arg,0,1);
			
			return $this->db->query($query, $arg);
		}
		
		
		
		
		//지역 관련 쿼리들
		function getInsertMajorLocation($arg)
		{
			$query = 'INSERT INTO TBL_CODE_LOCATION(LOC_NM) VALUES(?)';
			return $this->db->query($query, $arg);
		}
		
		function getUpdateMajorLocation($arg)
		{
			$query = 'UPDATE TBL_CODE_LOCATION 
									 SET LOC_NM = ?
								 WHERE LOC_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query, $arg);					   
		}
		
		function getDeleteMajorLocation($arg)
		{
			$query = 'UPDATE TBL_CODE_LOCATION SET DEL_YN = ? WHERE LOC_IDX = ?';
			return $this->db->query($query, $arg);
		}
		
		function getMajorLocationData($arg)
		{
			$query = 'SELECT LOC_IDX
											,LOC_NM
										
								  FROM TBL_CODE_LOCATION
								 WHERE LOC_IDX = ?
								   AND DEL_YN = ?';
			return $this->db->query($query, $arg);
		}
		
		function getMajorLocationList($arg)
		{
			$query = 'SELECT * 
	  						  FROM (SELECT B.LOC_IDX
															,B.LOC_NM
															,CONVERT(VARCHAR(10), B.REG_DT , 121) REG_DT
															,ROW_NUMBER() OVER (ORDER BY B.LOC_IDX DESC) ROW_NUM
											  			,COUNT(*) OVER() ALL_LIST_COUNT
							 				    FROM TBL_CODE_LOCATION B
							 				   WHERE 1=1';
		  if ($arg[0] != '') $query .= ' AND B.LOC_NM LIKE ?';
		  $query .= '
							 				   	 AND B.DEL_YN = ?) RTABLE
								  WHERE ROW_NUM >= ? AND ROW_NUM <= ?';
			
			if (!$arg[0]) array_splice($arg,0,1);
			
			return $this->db->query($query, $arg);
		}
		
		
	}
	