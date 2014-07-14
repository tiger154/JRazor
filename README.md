JRazor
======

In any project you can use RazorEngine through JRazor 

Console Application, Window Form Application, even WCF Service 
You can use Razor view engine through Jrazor 

The way use Jrazor 


1. Locate your own View File(.cshtml) 
 - {ProjectRoot}/View/{YourView.cshtml}
 * SO far you can't change Default "View Path"

2. Write Code in Client Project (With Just 3 line you can get your own Html string) 
 
 - dynamic lJView = new JView("ViewName") // If your View name is "YourView.chstml" you can write "YourView"
 - YourModel lModel = new YourModel{Name = "SomeName"}; // Usally you want to pass your own model into Html Template 
 - string RtnHtml = JrazorFactory.Instance().CreateHtml<YourModel>(lJView, YourModel); // you can get your Html Code generated 


* Dependency 
 - MVC 4 (4.0.20710.0) + 



Next version will be more flexable
when you have some idea or ploblem just let me know 

