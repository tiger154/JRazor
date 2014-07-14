JRazor
======

In any project you can use RazorEngine through JRazor 

Console Application, Window Form Application, even WCF Service 
You can use Razor view engine through Jrazor 

The way use Jrazor 


dynamic lJView = new JView("ViewPath")
YourModel lModel = new YourModel{Name = "SomeName"};

JrazorFactory.Instance().CreateHtml<YourModel>(lJView, YourModel);
