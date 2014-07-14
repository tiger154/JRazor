using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.IO;
using System.Web;
using System.Web.Mvc;
using System.Web.Routing;


namespace JRazorParser
{
    public class JViewRenderer : IJViewRenderer
    {
        /// <summary>
        /// Creates a new <see cref="EmailViewRenderer"/> that uses the given view engines.
        /// 기본 생성자. 주어진 뷰엔진을 이용해서... 
        /// </summary>
        /// <param name="viewEngines">The view engines to use when rendering email views.</param>
        public JViewRenderer(ViewEngineCollection viewEngines)
        {
            this.viewEngines = viewEngines;
            EmailViewDirectoryName = "Emails";
        }

        readonly ViewEngineCollection viewEngines;

        /// <summary>
        /// The name of the directory in "Views" that contains the email views.
        /// By default, this is "Emails".
        /// 
        /// 이메일 뷰를 포함하고 있는 딕셔너리 기본 값은 -> Emails! 
        /// </summary>
        public string EmailViewDirectoryName { get; set; }

      

        /// <summary>
        /// Renders an email view.
        /// 이메일 뷰를 렌더한다.. 여기가 포인트!!! 
        /// </summary>
        /// <param name="email">The email to render.</param>
        /// <param name="viewName">Optional email view name override. If null then the email's ViewName property is used instead.</param>
        /// <returns>The rendered email view output.</returns>
        public string Render<T>(JView lJohnsVieInfo, T aModel ,string viewName = null)
        {
            viewName = viewName ?? lJohnsVieInfo.ViewName;
            var controllerContext = CreateControllerContext();                                          // 콘트롤러Context를 만들고... 
            IViewExtension view = (IViewExtension)CreateView(viewName, controllerContext);              // 뷰를 만든다...(Render함수포함, 마스터 페이지는 없음..) 
            var viewOutput = RenderView<T>(view, lJohnsVieInfo.ViewData, controllerContext, aModel);    // 뷰 렌더링 
            
            return viewOutput;
        }

       



        ControllerContext CreateControllerContext()
        {
            // A dummy HttpContextBase that is enough to allow the view to be rendered.
            var httpContext = new HttpContextWrapper(
                new HttpContext(
                    new HttpRequest("", UrlRoot(), ""),
                    new HttpResponse(TextWriter.Null)
                )
            );
            var routeData = new RouteData();
            routeData.Values["controller"] = EmailViewDirectoryName;
            var requestContext = new RequestContext(httpContext, routeData);
            var stubController = new StubController();
            var controllerContext = new ControllerContext(requestContext, stubController);
            stubController.ControllerContext = controllerContext;
            return controllerContext;
        }

        string UrlRoot()
        {
            var httpContext = HttpContext.Current;
            if (httpContext == null)
            {
                return "http://localhost";
            }
            
            return httpContext.Request.Url.GetLeftPart(UriPartial.Authority) +
                   httpContext.Request.ApplicationPath;
        }

        IView CreateView(string viewName, ControllerContext controllerContext)
        {
            var result = viewEngines.FindView(controllerContext, viewName, null);
            if (result.View != null)
                return result.View;

            throw new Exception(
                "Email view not found for " + viewName + 
                ". Locations searched:" + Environment.NewLine +
                string.Join(Environment.NewLine, result.SearchedLocations)
            );
        }

        string RenderView(IView view, ViewDataDictionary viewData, ControllerContext controllerContext)
        {
            using (var writer = new StringWriter())
            {
                var viewContext = new ViewContext(controllerContext, view, viewData, new TempDataDictionary(), writer);
                view.Render(viewContext, writer);
                return writer.GetStringBuilder().ToString();
            }
        }

        string RenderView<T>(IViewExtension view, ViewDataDictionary viewData, ControllerContext controllerContext, T aModel)
        {
            using (var writer = new StringWriter())
            {
                var viewContext = new ViewContext(controllerContext, view, viewData, new TempDataDictionary(), writer); 

                view.RenderExtension<T>(viewContext, writer, aModel);  
               
                return writer.GetStringBuilder().ToString();
            }
        }

        

        // StubController so we can create a ControllerContext.
        class StubController : Controller { }
    }
}
