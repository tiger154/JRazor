<?
	class DateCheck_model extends CI_Model
	{
		/*
		 CHK_STEP_STDT : 시작일
		 CHK_STEP_EDDT : 종료일 
		 @CONDITION => CHK_STEP_STDT <= GETDATE()AND CHK_STEP_EDDT >= GETDATE()
		*/
		function getApplyCheck($arg)
		{
			 $query = 'SELECT STEP_IDX
											   ,STEP_STDT
											   ,STEP_EDDT
									   FROM (SELECT ROW_NUMBER() OVER (ORDER BY STEP_IDX) ORD
															   ,STEP_IDX
															   ,STEP_STDT
															   ,STEP_EDDT
															   ,STEP_STDT CHK_STEP_STDT
															   ,DATEADD(MINUTE,EXTEND_TIME,STEP_EDDT) CHK_STEP_EDDT
													   FROM TBL_STEP
													  WHERE PRJ_IDX = ?   
															AND DEL_YN = ?) RES
									  WHERE CHK_STEP_STDT <= GETDATE()
											AND CHK_STEP_EDDT >= GETDATE()
											AND ORD = 1';
					return $this->db->query($query, $arg);
		}
  }