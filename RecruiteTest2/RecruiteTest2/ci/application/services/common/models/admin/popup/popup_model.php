<?
	class popup_model extends CI_Model
	{
		function getList($arg)
		{
			$query = 'SELECT ROW_NUMBER() OVER(ORDER BY POP_IDX DESC) ORD
											,POP_IDX
											,POPUP_TITLE
											,CONVERT(VARCHAR(19), OPN_STDT, 121) OPN_STDT
											,CONVERT(VARCHAR(19), OPN_EDDT, 121) OPN_EDDT
											,POP_WIDTH
											,POP_HEIGHT
											,USE_YN
											,VIEW_TP
								  FROM TBL_POPUP
								 WHERE COMP_ID = ?
								   AND DEL_YN = \'N\'';
			return $this->db->query($query, $arg);
		}
		
		function getView($arg)
		{
			$query = 'SELECT POP_IDX
											,POPUP_TITLE
											,SUBSTRING(CONVERT(VARCHAR(19), OPN_STDT, 121),1,10) OPN_STDT1
											,SUBSTRING(CONVERT(VARCHAR(19), OPN_STDT, 121),12,2) OPN_STDT2
											,SUBSTRING(CONVERT(VARCHAR(19), OPN_STDT, 121),15,2) OPN_STDT3
											,SUBSTRING(CONVERT(VARCHAR(19), OPN_EDDT, 121),1,10) OPN_EDDT1
											,SUBSTRING(CONVERT(VARCHAR(19), OPN_EDDT, 121),12,2) OPN_EDDT2
											,SUBSTRING(CONVERT(VARCHAR(19), OPN_EDDT, 121),15,2) OPN_EDDT3
											,USE_YN
											,CNTNT
											,VIEW_TP
											,POP_WIDTH
											,POP_HEIGHT
								  FROM TBL_POPUP
								 WHERE COMP_ID = ?
								   AND POP_IDX = ?
								   AND DEL_YN = \'N\'';
			return $this->db->query($query, $arg);
		}
		
		function getProcess($arg)
		{
			$query = 'MERGE INTO TBL_POPUP AS T
										 USING (SELECT ? COMP_ID , ? POP_IDX) S
											  ON (S.COMP_ID = T.COMP_ID
										   AND S.POP_IDX = T.POP_IDX)
										  WHEN MATCHED THEN
										UPDATE SET POPUP_TITLE = ?
												   		,OPN_STDT = CONVERT(DATETIME,?)
												   		,OPN_EDDT = CONVERT(DATETIME,?)
												   		,USE_YN = ?
												   		,CNTNT = ?
												   		,POP_WIDTH = ?
															,POP_HEIGHT = ?
															,VIEW_TP = ?
										  WHEN NOT MATCHED THEN  
										INSERT (COMP_ID,POPUP_TITLE,OPN_STDT,OPN_EDDT,USE_YN,CNTNT,POP_WIDTH,POP_HEIGHT,VIEW_TP)
										VALUES (?,?,CONVERT(DATETIME,?),CONVERT(DATETIME,?),?,?,?,?,?);';
			return $this->db->query($query, $arg);							
		}
		
		function getDelete($arg)
		{
			$query = 'UPDATE TBL_POPUP 
									 SET DEL_YN = \'Y\' 
								 WHERE COMP_ID = ? 
								   AND POP_IDX = ?';
			return $this->db->query($query, $arg);
		}
		
		function getCreateList($arg)
		{
			$query = "SELECT A.POP_IDX
											,A.POPUP_TITLE
											,REPLACE(REPLACE(REPLACE(CONVERT(VARCHAR(19), A.OPN_STDT, 121),'-',''),':',''),' ','') OPN_STDT
											,REPLACE(REPLACE(REPLACE(CONVERT(VARCHAR(19), A.OPN_EDDT, 121),'-',''),':',''),' ','') OPN_EDDT
											,A.CNTNT
											,B.DOMAIN_ID
											,POP_WIDTH
											,POP_HEIGHT
											,VIEW_TP
								  FROM TBL_POPUP A
								  JOIN TBL_COMPANY B
								    ON A.COMP_ID = B.COMP_ID 
								 WHERE B.COMP_ID = ?
								   AND A.OPN_STDT <= GETDATE()
								   AND A.OPN_EDDT >= GETDATE()
								   AND A.DEL_YN = 'N'
								   AND A.USE_YN = 'Y'
								   AND B.DEL_YN = 'N'";
			return $this->db->query($query, $arg);
		}
		
	}
	
								