<script language="javascript" src="/assets/js/json2.js"></script>
<script language="javascript" src="/assets/js/jQuery.XDomainRequest.js"></script>
<script type="text/javascript">
	
		$.support.cors = true;
		
		function bodyOnLoad()
		{
				
				$.ajax({
					url: "http://sendmail.trns.co.kr:18023/MailService.asmx/SendMailByGrouping",
					type: "GET",
					data: {mail_idx:<?=$MAIL_IDX?>,per_count:3,delay:1000},
					contentType: "application/xml; charset=utf-8",
					dataType: "xml",
					success: function(data){
						//alert(data.text);
						//alert('�߼۵Ǿ����ϴ�.');
						//window.close();
					},
					error: function(jqXHR, textStatus){
						//alert(textStatus);
					}
				});
				
				alert('�߼۵Ǿ����ϴ�.');
				window.close();
		}
</script>
