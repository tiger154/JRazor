<?
	class Popup_model extends CI_Model
	{
		
		function getLicenseList($arg,$flag)
		{
		
			$query = '  SELECT A.LIC_IDX CODE
												,B.CD_NM TITLE2
												,A.LIC_NM NAME
												,A.LIC_PB TITLE1
												,B.CD_CD ETCFLAG
								    FROM TBL_CODE_LICENSE A
								    JOIN TBL_CODE B
								      ON A.CD_IDX = B.CD_IDX
								   WHERE B.CD_GB = ?';
			if ($arg[1] != null)
			{
				if ($flag == 'search') $query .= '    AND LIC_NM LIKE ? ';
				if ($flag == 'etc') 	 $query .= '    AND B.CD_CD = ? ';
			}
			
			if (!$arg[1] || ( $arg[1] != '' && $flag == 'search' ) ) $query .= ' AND B.CD_CD IS NULL ';
			
			$query .= '
								     AND A.DEL_YN = ?
								     AND B.DEL_YN = ?
								     AND B.USE_YN = ?';
				
			if (!$arg[1]) array_splice($arg,1,1);
			
			return $this->db->query($query, $arg);
		}
		
		
		function getSchoolList($arg,$flag)
		{
		
			$query = '  SELECT A.SCH_IDX CODE
												,A.SCH_NM NAME
												,B.CD_CD ETCFLAG
								    FROM TBL_CODE_SCHOOL A
								    JOIN TBL_CODE B
								      ON A.CD_IDX = B.CD_IDX
								   WHERE B.CD_GB = ? 
								     AND B.CD_IDX = ? ';
			if ($arg[2] != null)
			{
				if ($flag == 'search') $query .= '    AND SCH_NM LIKE ? ';
				if ($flag == 'etc') 	 $query .= '    AND B.CD_CD = ? ';
			}
			
			if (!$arg[2] || ( $arg[2] != '' && $flag == 'search' ) ) $query .= ' AND B.CD_CD IS NULL ';
			
			$query .= '
								     AND A.DEL_YN = ?
								     AND B.DEL_YN = ?
								     AND B.USE_YN = ?';
				
			if (!$arg[2]) array_splice($arg,2,1);
			
			return $this->db->query($query, $arg);
		}
		
		function getMajorList($arg,$flag)
		{
		
			$query = '  SELECT A.MJR_IDX CODE
												,A.MJR_NM NAME
												,B.CD_CD ETCFLAG
								    FROM TBL_CODE_MAJOR A
								    JOIN TBL_CODE B
								      ON A.CD_IDX = B.CD_IDX
								   WHERE B.CD_GB = ?';
			if ($arg[1] != null)
			{
				if ($flag == 'search') $query .= '    AND MJR_NM LIKE ? ';
				if ($flag == 'etc') 	 $query .= '    AND B.CD_CD = ? ';
			}
			
			if (!$arg[1] || ( $arg[1] != '' && $flag == 'search' ) ) $query .= ' AND B.CD_CD IS NULL ';
			
			$query .= '
								     AND A.DEL_YN = ?
								     AND B.DEL_YN = ?
								     AND B.USE_YN = ?';
				
			if (!$arg[1]) array_splice($arg,1,1);
			
			return $this->db->query($query, $arg);
		}
		
		function getAddressList($arg)
		{
			$query = 'SELECT SUBSTRING(ZIPCODE,1,3) ZIPCODE1
											,SUBSTRING(ZIPCODE,4,3) ZIPCODE2
										  ,FULL_ADDRESS 
								  FROM TBL_ZIPCODE
								 WHERE GUNGU LIKE ?
								    OR MYDONG LIKE ?
								    OR LI LIKE ?';
			return $this->db->query($query, $arg);
		}
		
		function getJobTypeMainList($arg)
		{
			$query = ' SELECT JOB_NM 
										   ,JOB_IDX
								   FROM TBL_CODE_JOB 
								  WHERE JOB_PIDX IS NULL
								    AND DEL_YN = ?';
			return $this->db->query($query, $arg);
		}
		
		function getJobTypeSubList($arg)
		{
			$query = ' SELECT JOB_NM 
										   ,JOB_IDX
								   FROM TBL_CODE_JOB 
								  WHERE JOB_PIDX = ?
								    AND DEL_YN = ?';
			return $this->db->query($query, $arg);
		}
		
		
		
	}