<?
class BbsManagement_model extends CI_Model
{
	//게시판에 작성된 글 리스트 가져오기
	function getBbsList($arg) {
		$query = 'DECLARE @CUR_PAGE INT
      , @PAGE_SIZE INT
      , @DEL_YN CHAR(1)
      , @PRJ_IDX INT
      , @BBS_GROUP_IDX INT
      , @START_ROWNUM INT
      , @END_ROWNUM INT
    SET @DEL_YN = ?
    SET @PRJ_IDX = ?
    SET @BBS_GROUP_IDX = ?
	SET @CUR_PAGE = ?
    SET @PAGE_SIZE = ?
    
    SET @START_ROWNUM = @PAGE_SIZE * (@CUR_PAGE - 1) + 1
    SET @END_ROWNUM = @START_ROWNUM + @PAGE_SIZE - 1

 SELECT TOP ? * FROM (
 SELECT ROW_NUMBER() OVER(ORDER BY B.REF_BBS_IDX DESC, B.DEPTH ASC) AS ROWNUM
      , B.BBS_IDX
      , B.PRJ_IDX
      , B.REF_BBS_IDX
	  , LEN(B.DEPTH) - 1 AS STEP
      , B.DEPTH
      , P.PRJ_NM
      , B.BBS_TITLE
      , B.MANAGER_ID
      , B.APPL_IDX
	  , B.WRITER_NM
      , CONVERT(VARCHAR(10), B.REG_DT, 21) AS REG_DT
      , B.HIT
      , COUNT(1) OVER() AS TOTAL_COUNT
   FROM TBL_BBS B
  INNER JOIN TBL_BBS_GROUP BG
     ON B.BBS_GROUP_IDX = BG.BBS_GROUP_IDX
  INNER JOIN TBL_PROJECT P
     ON B.PRJ_IDX = P.PRJ_IDX
  WHERE B.DEL_YN = @DEL_YN
    AND B.PRJ_IDX = @PRJ_IDX 
    AND B.BBS_GROUP_IDX = @BBS_GROUP_IDX
  ) T
  WHERE ROWNUM BETWEEN @START_ROWNUM and @END_ROWNUM';
		return $this->db->query($query , $arg);
    }

		//게시판에 작성된 글 가져오기
	function getBbs($arg) {
		$query = 'DECLARE @DEL_YN CHAR(1)
      , @BBS_IDX INT
    SET @DEL_YN = ?
    SET @BBS_IDX = ?
 SELECT BBS_IDX, BBS_GROUP_IDX, PRJ_IDX, REF_BBS_IDX, PARENT_BBS_IDX, BBS_TITLE, BBS_CONTENT, HIT, STATUS, EDIT_DT, EMAIL, CONVERT(VARCHAR(10), REG_DT, 21) REG_DT, END_DT, IP_ADDR, MANAGER_ID, APPL_IDX, WRITER_NM
   FROM TBL_BBS
  WHERE DEL_YN = @DEL_YN
    AND BBS_IDX = @BBS_IDX';
		return $this->db->query($query , $arg);
    }

	//새글 작성
	function deleteBbs($arg) {
		$query = 'DECLARE @BBS_IDX INT, @PASSWD VARCHAR(32)
    SET @BBS_IDX = ?
    SET @PASSWD = ?
		IF @PASSWD IS NOT NULL
		BEGIN
		UPDATE TBL_BBS
		   SET DEL_YN = \'Y\'
		 WHERE BBS_IDX = @BBS_IDX
		   AND PASSWD = @PASSWD AND DEL_YN = \'N\'
		SELECT BBS_IDX FROM TBL_BBS WHERE BBS_IDX = @BBS_IDX AND PASSWD = @PASSWD;
		END 
		ELSE
		BEGIN
		UPDATE TBL_BBS
		   SET DEL_YN = \'Y\'
		 WHERE BBS_IDX = @BBS_IDX
		   AND DEL_YN = \'N\'
		END
		';
		return $this->db->query($query , $arg);
    }

	//새글 작성
	function insertBbs($arg) {
		$query = 'DECLARE @BBS_IDX INT
      , @BBS_GROUP_IDX INT
      , @PRJ_IDX INT
      , @BBS_TITLE NVARCHAR(200)
      , @BBS_CONTENT NVARCHAR(MAX)
      , @IP_ADDR VARCHAR(45)
      , @MANAGER_ID VARCHAR(20)
      , @APPL_IDX INT
      , @WRITER_NM VARCHAR(20)
      , @EMAIL VARCHAR(100)
      , @PASSWD VARCHAR(32)
    SET @BBS_IDX = ?
    SET @BBS_GROUP_IDX = ?
    SET @PRJ_IDX = ?
    SET @BBS_TITLE = ?
    SET @BBS_CONTENT = ?
    SET @IP_ADDR = ?
    SET @MANAGER_ID = ?
    SET @APPL_IDX = ?
    SET @WRITER_NM = ?
    SET @EMAIL = ?
    SET @PASSWD = ?
IF @WRITER_NM IS NULL
BEGIN
SELECT @WRITER_NM = (CASE WHEN @MANAGER_ID <> \'\' 
						 THEN (SELECT MANAGER_NM FROM TBL_MANAGER WHERE MANAGER_ID = @MANAGER_ID)
					 WHEN @APPL_IDX > 0 
						 THEN (SELECT NAMEKOR FROM TBL_APPLY WHERE APPL_IDX = @APPL_IDX)
					 ELSE \'\'
					 END)
END
IF @PASSWD IS NOT NULL 
BEGIN
		
		IF @BBS_IDX > 0
		BEGIN
		    UPDATE TBL_BBS
		       SET BBS_TITLE = @BBS_TITLE
		         , BBS_CONTENT = @BBS_CONTENT
		         , EMAIL = @EMAIL
		         , WRITER_NM = @WRITER_NM
		     WHERE BBS_IDX = @BBS_IDX
		       AND PASSWD = @PASSWD;
		    SELECT BBS_IDX
		      FROM TBL_BBS
		     WHERE BBS_IDX = @BBS_IDX AND PASSWD = @PASSWD;
		END
		ELSE
		BEGIN
		    INSERT INTO TBL_BBS(BBS_GROUP_IDX, PRJ_IDX, BBS_TITLE, BBS_CONTENT, IP_ADDR, MANAGER_ID, APPL_IDX, WRITER_NM, EMAIL, PASSWD)
		    SELECT @BBS_GROUP_IDX
		         , @PRJ_IDX
		         , @BBS_TITLE AS BBS_TITLE
		         , @BBS_CONTENT AS BBS_CONTENT
		         , @IP_ADDR AS IP_ADDR
		         , CASE WHEN @MANAGER_ID = \'\' THEN NULL ELSE @MANAGER_ID END AS MANAGER_ID
		         , CASE WHEN @APPL_IDX = 0 THEN NULL ELSE @APPL_IDX END AS APPL_IDX
		         , @WRITER_NM AS WRITER_NM
		         , @EMAIL
		         , @PASSWD;
		    SELECT SCOPE_IDENTITY() AS BBS_IDX;
		END
		
END 
ELSE
BEGIN
		
		IF @BBS_IDX > 0
		BEGIN
		    UPDATE TBL_BBS
		       SET BBS_TITLE = @BBS_TITLE
		         , BBS_CONTENT = @BBS_CONTENT
		         , EMAIL = @EMAIL
		         , WRITER_NM = @WRITER_NM
		     WHERE BBS_IDX = @BBS_IDX;
		    SELECT @BBS_IDX AS BBS_IDX;
		END
		ELSE
		BEGIN
		    INSERT INTO TBL_BBS(BBS_GROUP_IDX, PRJ_IDX, BBS_TITLE, BBS_CONTENT, IP_ADDR, MANAGER_ID, APPL_IDX, WRITER_NM, EMAIL, PASSWD)
		    SELECT @BBS_GROUP_IDX
		         , @PRJ_IDX
		         , @BBS_TITLE AS BBS_TITLE
		         , @BBS_CONTENT AS BBS_CONTENT
		         , @IP_ADDR AS IP_ADDR
		         , CASE WHEN @MANAGER_ID = \'\' THEN NULL ELSE @MANAGER_ID END AS MANAGER_ID
		         , CASE WHEN @APPL_IDX = 0 THEN NULL ELSE @APPL_IDX END AS APPL_IDX
		         , @WRITER_NM AS WRITER_NM
		         , @EMAIL
		         , @PASSWD;
		    SELECT SCOPE_IDENTITY() AS BBS_IDX;
		END
		
END';
		return $this->db->query($query , $arg);
    }

	//답변 하기
	function insertBbsAnswer($arg) {
		$query = 'DECLARE @BBS_IDX INT
      , @BBS_TITLE NVARCHAR(200)
      , @BBS_CONTENT NVARCHAR(MAX)
      , @HIT INT
      , @IP_ADDR VARCHAR(45)
      , @MANAGER_ID VARCHAR(20)
      , @APPL_IDX INT
      , @WRITER_NM VARCHAR(20)
    SET @BBS_IDX = ?
    SET @BBS_TITLE = ?
    SET @BBS_CONTENT = ?
    SET @IP_ADDR = ?
    SET @MANAGER_ID = ?
    SET @APPL_IDX = ?

SELECT @WRITER_NM = (CASE WHEN @MANAGER_ID <> \'\' 
						 THEN (SELECT MANAGER_NM FROM TBL_MANAGER WHERE MANAGER_ID = @MANAGER_ID)
					 WHEN @APPL_IDX > 0 
						 THEN (SELECT NAMEKOR FROM TBL_APPLY WHERE APPL_IDX = @APPL_IDX)
					 ELSE \'\'
					 END)

INSERT INTO TBL_BBS(BBS_GROUP_IDX, PRJ_IDX, REF_BBS_IDX,PARENT_BBS_IDX, DEPTH, BBS_TITLE, BBS_CONTENT, IP_ADDR, MANAGER_ID, APPL_IDX, WRITER_NM)
SELECT B.BBS_GROUP_IDX AS BBS_GROUP_IDX
     , B.PRJ_IDX AS PRJ_IDX
     , B.REF_BBS_IDX AS REF_BBS_IDX
     , B.BBS_IDX AS PARENT_BBS_IDX
     , ISNULL(DBO.FN_NEXTDEPTH(P.DEPTH), B.DEPTH + \'A\') AS DEPTH
     , @BBS_TITLE AS BBS_TITLE
     , @BBS_CONTENT AS BBS_CONTENT
     , @IP_ADDR AS IP_ADDR
     , CASE WHEN @MANAGER_ID = \'\' THEN NULL ELSE @MANAGER_ID END AS MANAGER_ID
     , CASE WHEN @APPL_IDX = 0 THEN NULL ELSE @APPL_IDX END AS APPL_IDX
     , @WRITER_NM AS WRITER_NM
FROM TBL_BBS B
LEFT JOIN (SELECT PARENT_BBS_IDX, COUNT(1) AS CNT, MAX(DEPTH) AS DEPTH FROM TBL_BBS WHERE PARENT_BBS_IDX = @BBS_IDX GROUP BY PARENT_BBS_IDX ) P
ON B.BBS_IDX = P.PARENT_BBS_IDX
WHERE B.BBS_IDX = @BBS_IDX
SELECT SCOPE_IDENTITY() AS BBS_IDX';
		return $this->db->query($query , $arg);
    }

	//게시판 그룹 가져오기
	function getBbsGroup($arg) {
		 $query = 'SELECT BBS_GROUP_IDX
							      , BBS_TYPE
							      , BBS_URL
							      , BBS_NAME
							      , ALIST_CNT
							      , APAGE_CNT
							      , WRITE_YN
							   FROM TBL_BBS_GROUP
							  WHERE PRJ_IDX = ?
							    AND BBS_TYPE = ?
							    AND DEL_YN = ?';
		return $this->db->query($query , $arg);
    }

	//선택된 게시판 그룹 가져오기
	function getBbsGroupIdx($arg) {
		$query = 'DECLARE @DEL_YN CHAR(1)
      , @PRJ_IDX INT
      , @BBS_TYPE VARCHAR(10)
    SET @DEL_YN = ?
    SET @PRJ_IDX = ?
    SET @BBS_TYPE = ?
 SELECT BBS_GROUP_IDX
      , BBS_TYPE
      , BBS_URL
      , BBS_NAME
      , CASE WHEN @BBS_TYPE = BBS_TYPE THEN 1 ELSE 0 END AS SELECTED
   FROM TBL_BBS_GROUP
  WHERE DEL_YN = @DEL_YN
    AND PRJ_IDX = @PRJ_IDX
	AND BBS_TYPE = @BBS_TYPE';
		return $this->db->query($query , $arg);
    }

	//파일 목록 가져오기
	function getBbsFiles($arg) {
		$query = 'DECLARE @DEL_YN CHAR(1)
      , @BBS_IDX INT
    SET @DEL_YN = ?
    SET @BBS_IDX = ?
 SELECT ROW_NUMBER() OVER(ORDER BY FLS_IDX ASC) AS ROWNUM
      , FLS_IDX
	  , BBS_IDX
	  , SAVE_FOLD
	  , FILE_NAME
	  , SAVE_NAME
	  , FILE_SIZE
	  , FILE_EXT
	  , IS_IMAGE
	  , REG_DT
	  , MANAGER_ID
	  , APPL_IDX
	  , DEL_YN
   FROM TBL_BBS_FILES
  WHERE DEL_YN = @DEL_YN
    AND BBS_IDX = @BBS_IDX';
		return $this->db->query($query , $arg);
    }

	//파일 저장
	function insertBbsFiles($arg) {
		$query = 'DECLARE @FLS_IDX INT
      , @BBS_IDX INT
      , @SAVE_FOLD CHAR(8)
      , @FILE_NAME NVARCHAR(200)
      , @SAVE_NAME VARCHAR(100)
      , @FILE_SIZE INT
      , @FILE_EXT VARCHAR(10)
	  , @IS_IMAGE BIT
      , @MANAGER_ID VARCHAR(20)
      , @APPL_IDX INT
      , @DEL_YN CHAR(1)
    SET @FLS_IDX = ?
    SET @BBS_IDX = ?
	SET @SAVE_FOLD = ?
    SET @FILE_NAME = ?
    SET @SAVE_NAME = ?
    SET @FILE_SIZE = ?
    SET @FILE_EXT = ?
	SET @IS_IMAGE = ?
    SET @MANAGER_ID = ?
    SET @APPL_IDX = ?
    SET @DEL_YN = ?
 IF @FLS_IDX > 0
 BEGIN
     UPDATE TBL_BBS_FILES
        SET DEL_YN = @DEL_YN
      WHERE FLS_IDX = @FLS_IDX
 END
 ELSE
 BEGIN
     INSERT INTO TBL_BBS_FILES(BBS_IDX, SAVE_FOLD, FILE_NAME, SAVE_NAME, FILE_SIZE, FILE_EXT, IS_IMAGE, MANAGER_ID, APPL_IDX, DEL_YN)
     SELECT @BBS_IDX
          , @SAVE_FOLD
	      , @FILE_NAME
	      , @SAVE_NAME
	      , @FILE_SIZE
	      , @FILE_EXT
	      , @IS_IMAGE
	      , CASE WHEN @MANAGER_ID = \'\' THEN NULL ELSE @MANAGER_ID END AS MANAGER_ID
          , CASE WHEN @APPL_IDX = 0 THEN NULL ELSE @APPL_IDX END AS APPL_IDX
		  , @DEL_YN
 END';
		return $this->db->query($query , $arg);
    }


	//파일 저장
	function getPrjCombo($arg) {
		$query = 'SELECT \'0\' AS [ID], \'- 전체보기 -\' AS [TEXT]
 UNION ALL
 SELECT PRJ_IDX, PRJ_NM
   FROM TBL_PROJECT
  WHERE COMP_ID = ?
  	AND DEL_YN = \'N\'
    AND USE_YN = \'Y\'
    AND PRJ_STS = \'O\'';
		return $this->db->query($query,$arg);
    }
    
    
  function getBbsGroupList($arg)
  {
  	$query = 'SELECT BBS_GROUP_IDX 
									  ,BBS_TYPE
									  ,BBS_NAME
									  ,ALIST_CNT
									  ,APAGE_CNT
									  ,DP_TP
									  ,REPLY_DP_TP
							  FROM TBL_BBS_GROUP 
							 WHERE PRJ_IDX = 30
							   AND DEL_YN = \'N\'';
		return $this->db->query($query,$arg);					   
  }
}


