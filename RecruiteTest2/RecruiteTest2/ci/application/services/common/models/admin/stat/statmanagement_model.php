<?
	class Statmanagement_model extends CI_Model
	{
	
		function getStatStepList($arg)
    {
		 $query = 'SELECT COUNT(*) CNT
									   ,MIN(PRJ_IDX) PRJ_IDX
									   ,NULL STEP_IDX
									   ,\'ÃÑÀÎ¿ø\' STEP_NM
									   ,0 ORD_NO
							   FROM TBL_APPLY X
							  WHERE X.PRJ_IDX = ? 
							    AND X.APPL_YN = \'Y\'
							    AND X.DEL_YN = \'N\'
							  UNION ALL
							 SELECT COUNT(*) CNT
									   ,MIN(PRJ_IDX) PRJ_IDX
									   ,0 STEP_IDX
									   ,\'¹Ì´Þ\' STEP_NM
									   ,0 ORD_NO
							   FROM TBL_APPLY X
							  WHERE X.PRJ_IDX = ? 
							    AND X.APPL_YN = \'Y\'
							    AND X.FAIL_YN = \'Y\'
							    AND X.DEL_YN = \'N\'
							  UNION ALL
							 SELECT CNT
									   ,B.PRJ_IDX
									   ,B.STEP_IDX
									   ,B.STEP_NM 
									   ,B.ORD_NO
							   FROM ( SELECT COUNT(*) CNT 
															,STEP_IDX
															,MAX(X.PRJ_IDX) PRJ_IDX
													FROM TBL_APPLY X
											   WHERE X.PRJ_IDX = ?
													 AND X.APPL_YN = \'Y\'
													 AND X.FAIL_YN = \'N\'
													 AND DEL_YN = \'N\'
									    GROUP BY X.STEP_IDX ) A
RIGHT OUTER JOIN TBL_STEP B
							ON A.PRJ_IDX = B.PRJ_IDX
						 AND A.STEP_IDX = B.STEP_IDX
					 WHERE B.PRJ_IDX = ? AND B.DEL_YN = \'N\'';
			return $this->db->query($query, $arg);
    }
    
    function getStatUnitList($unitArrayList,$PRJ_IDX)
    {
    	$arrayList = $unitArrayList;
    	$queryStrCount = '';
    	$queryStrSum = '';
    	foreach ($unitArrayList as $key => $unitList)
    	{
    		$pkey = $key + 1;
    		$queryStrSum .= ',SUM(U' . $pkey . ') U' . $pkey . ' ';
    		$queryStrCount .= ',COUNT((CASE UNIT_IDX WHEN ? THEN UNIT_IDX ELSE NULL END)) U' . $pkey . ' ';
    	}
    	
    	$query = ' SELECT DT
										   ' . $queryStrSum . ' 
									   FROM (SELECT CONVERT(VARCHAR(10),APPL_DT,121) DT
												   ' . $queryStrCount . ' 
											   FROM TBL_APPLY A
											   JOIN TBL_APPLY_UNIT B
												 ON A.PRJ_IDX = B.PRJ_IDX 
											    AND A.APPL_IDX = B.APPL_IDX 
											  WHERE A.PRJ_IDX = ?
											    AND A.DEL_YN = \'N\'
											   AND A.APPL_YN = \'Y\'
												 AND B.ORD = 1
										   GROUP BY UNIT_IDX,CONVERT(VARCHAR(10),APPL_DT,121) ) R
								   GROUP BY DT ';
			$query .= ' UNION ALL ';
			$arrayList[] = $PRJ_IDX;
			$query .= ' SELECT \'ÃÑ°è\' COL
										   ' . $queryStrSum . ' 
									   FROM (SELECT CONVERT(VARCHAR(10),APPL_DT,121) DT
												   ' . $queryStrCount . ' 
											   FROM TBL_APPLY A
											   JOIN TBL_APPLY_UNIT B
												 ON A.PRJ_IDX = B.PRJ_IDX 
											    AND A.APPL_IDX = B.APPL_IDX 
											  WHERE A.PRJ_IDX = ?
											    AND A.DEL_YN = \'N\'
											   AND A.APPL_YN = \'Y\'
												 AND B.ORD = 1
										   GROUP BY UNIT_IDX,CONVERT(VARCHAR(10),APPL_DT,121) ) R ';
			
			$arrayList = array_merge($arrayList,$unitArrayList);
			$arrayList[] = $PRJ_IDX;
			return $this->db->query($query, $arrayList);					   
    }
    
    function getStatQueryList($PRJ_IDX,$TBL_NM, $GROUP_COLUMN, $LIST_COLUMN,$arrayList)
		{
			$_arrayList = $arrayList;
			$queryStrSum = null;
			$queryStrCount = null;
			foreach ($arrayList as $key => $unitList)
    	{
    		$pkey = $key + 1;
    		$queryStrSum .= ',SUM(C' . $pkey . ') C' . $pkey . ' ';
    		$queryStrCount .= ',COUNT((CASE ' . $GROUP_COLUMN . ' WHEN ? THEN ' . $GROUP_COLUMN . ' ELSE NULL END)) C' . $pkey . ' ';
    	}
    	
  	  $query = ' SELECT TITLE
									   ' . $queryStrSum . ' 
								   FROM (SELECT ' . $LIST_COLUMN . ' TITLE
											   ' . $queryStrCount . ' 
												   FROM TBL_APPLY A
												   JOIN ' . $TBL_NM . ' B
													   ON A.PRJ_IDX = B.PRJ_IDX 
												    AND A.APPL_IDX = B.APPL_IDX 
												  WHERE A.PRJ_IDX = ?
												    AND A.DEL_YN = \'N\'
												    AND A.APPL_YN = \'Y\'
										   GROUP BY ' . $GROUP_COLUMN . ',' . $LIST_COLUMN . ' ) R
					     GROUP BY TITLE';
			$_arrayList[] = $PRJ_IDX;
			$query .= ' UNION ALL ';		     
			$query .= ' SELECT TITLE
									   ' . $queryStrSum . ' 
								   FROM (SELECT \'ÃÑ°è\' TITLE
											   ' . $queryStrCount . ' 
												   FROM TBL_APPLY A
												   JOIN ' . $TBL_NM . ' B
													   ON A.PRJ_IDX = B.PRJ_IDX 
												    AND A.APPL_IDX = B.APPL_IDX 
												  WHERE A.PRJ_IDX = ?
												    AND A.DEL_YN = \'N\'
												    AND A.APPL_YN = \'Y\'
										   GROUP BY ' . $GROUP_COLUMN . ',' . $LIST_COLUMN . ' ) R
					     GROUP BY TITLE';		     
			$_arrayList = array_merge($_arrayList,$arrayList);
			$_arrayList[] = $PRJ_IDX;
			return $this->db->query($query, $_arrayList);
		}
    
  }