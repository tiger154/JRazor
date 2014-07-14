<?
	class ReportService_model extends CI_Model
	{
		
		function reportData($arg)
		{
			$query = 'INSERT INTO TBL_REPORT_DATA (RPT_IDX,TITLE_GUBUN,APPLY_NO) VALUES(?,?,?)';
			return $this->db->query($query, $arg);
		}
		
		function reportDataDelete($arg)
		{
			$query = 'DELETE FROM TBL_REPORT_DATA WHERE RPT_IDX = (SELECT RPT_IDX FROM TBL_REPORT_LIST WHERE PRJ_IDX = ? AND DEL_YN = \'N\')';
			return $this->db->query($query, $arg);
		}
		
		function reportDelete($arg)
		{
			$query = 'UPDATE TBL_REPORT_LIST SET DEL_YN = \'Y\' WHERE PRJ_IDX = ?';
			return $this->db->query($query, $arg);
		}
		
		function reportRegist($arg)
    {
    	$query = 'INSERT INTO TBL_REPORT_LIST (
    														PRJ_IDX
    														,MANAGER_ID
    														,COL_SIZE
    														,ROW_SIZE
    														,REVERSE_YN
    														,PHOTO_YN
    														,COLUMN_LIST1
    														,COLUMN_LIST2
    														,COLUMN_LIST3
    														,DEL_YN
    														,SORT_TP)
					  										VALUES (?,?,?,?,?,?,?,?,?,?,?)';
			$this->db->query($query, $arg);
			return $this->db->insert_id();
    }
    
    function getReportConstraint($arg)
    {
	  	 $query = 'SELECT RPT_IDX
										   ,PRJ_IDX
										   ,MANAGER_ID
										   ,COL_SIZE
										   ,ROW_SIZE
										   ,PHOTO_YN
										   ,COLUMN_LIST1
										   ,COLUMN_LIST2
										   ,COLUMN_LIST3
										   ,COLUMN_LIST4
										   ,SORT_TP
										   ,REVERSE_YN
								   FROM TBL_REPORT_LIST
								  WHERE PRJ_IDX = ?
								    AND DEL_YN = \'N\'';
			return $this->db->query($query, $arg);
    }
    
    function commonReportList($PRJ_IDX,$COL_SIZE,$GUBUN_TITLE,$COLUMN_LIST1,$COLUMN_LIST2,$COLUMN_LIST3,$SORT_TP,$REVERSE_YN)
    {
    	$obj = array();
    	
    	$GUBUN_TITLE_QUERY = null;
    	
    	$obj[] = $COL_SIZE;
    	$obj[] = $COL_SIZE;
    	$obj[] = $COL_SIZE;
    	$obj[] = $PRJ_IDX;
    	$obj[] = $PRJ_IDX;
    	if ($GUBUN_TITLE != null)
    	{
    		$GUBUN_TITLE_QUERY = ' AND TITLE_GUBUN = ? ';
    		$obj[] = $GUBUN_TITLE;
    	}
    	
    	$SORT_TP = $SORT_TP != null ? $SORT_TP : 'GRPA.APPLY_NO';
    	$REVERSE_YN = $REVERSE_YN == 'Y' ? ' DESC ' : ' ASC ';
    	$COLUMN_LIST1 = $COLUMN_LIST1 != null ? $COLUMN_LIST1 : '\' \'';
    	$COLUMN_LIST2 = $COLUMN_LIST2 != null ? $COLUMN_LIST2 : '\' \'';
    	$COLUMN_LIST3 = $COLUMN_LIST3 != null ? $COLUMN_LIST3 : '\' \'';
    	
    	$query = 'SELECT CASE ORD % ? WHEN 0 THEN ? ELSE ORD % ? END COL_SIZE
										  ,RES.*
								  FROM (SELECT ROW_NUMBER() OVER (PARTITION BY GRPA.TITLE_GUBUN ORDER BY ' . $SORT_TP . ' ' . $REVERSE_YN . ' ) ORD
								  						,GRPA.APPLY_NO 
														  ,' . $COLUMN_LIST1 . ' COL1
														  ,' . $COLUMN_LIST2 . ' COL2
														  ,' . $COLUMN_LIST3 . ' COL3
														  ,GRPB.APPL_IDX
														  ,GRPA.TITLE_GUBUN
														  ,COUNT(*) OVER (PARTITION BY GRPA.TITLE_GUBUN) GUBUN_CNT
											  FROM (SELECT TITLE_GUBUN
											  						,APPLY_NO
																	  ,? PRJ_IDX
															  FROM TBL_REPORT_DATA
															 WHERE RPT_IDX = ( SELECT RPT_IDX 
															 										 FROM TBL_REPORT_LIST 
															 										WHERE PRJ_IDX = ? 
															 										  AND DEL_YN = \'N\' )
															 	 ' . $GUBUN_TITLE_QUERY . ' ) GRPA
											  JOIN TBL_APPLY GRPB
													ON GRPA.PRJ_IDX = GRPB.PRJ_IDX
											   AND GRPA.APPLY_NO = GRPB.APPLY_NO
											  JOIN TBL_APPLY_UNIT GRPC
											    ON GRPB.PRJ_IDX = GRPC.PRJ_IDX
											   AND GRPB.APPL_IDX = GRPC.APPL_IDX 
											  JOIN TBL_UNIT GRPD
											    ON GRPC.PRJ_IDX = GRPD.PRJ_IDX
											   AND GRPC.UNIT_IDX = GRPD.UNIT_IDX
											 WHERE GRPC.ORD = 1
											   AND GRPB.DEL_YN = \'N\'
											   AND GRPC.DEL_YN = \'N\'
											   AND GRPD.DEL_YN = \'N\') RES';
			
    	return $this->db->query($query, $obj);
    }
    
  }