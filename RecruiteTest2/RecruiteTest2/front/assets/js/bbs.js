function changeProject()
{
	location.replace($("#pageUrl").val() + $("#bbsType").val() + '?project_id=' + $("#PRJ_IDX").val());
}