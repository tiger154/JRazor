using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using RazorEngine;
using RazorEngine.Templating;
using System.Web.Mvc;
using System.IO;

namespace JRazorParser
{


    public class FileSystemRazorView : IViewExtension
    {
        readonly string template;
        readonly string cacheName;

        /// <summary>
        /// Creates a new <see cref="FileSystemRazorView"/> using the given view filename.
        /// 
        /// 생성자 , 지정된 파일 경로를 통해 스트링을 읽어들인다. 
        /// 
        /// </summary>
        /// <param name="filename">The filename of the view.</param>
        public FileSystemRazorView(string filename)
        {
            template = File.ReadAllText(filename);
            cacheName = filename;
        }


        /// <summary>
        /// 특정 모델을 받아온후 렌더링..  View를 확장하여 사용한다.. 이게 핵심..
        /// </summary>
        /// <typeparam name="T"></typeparam>
        /// <param name="viewContext"></param>
        /// <param name="writer"></param>
        /// <param name="aModel"></param>
        public void RenderExtension<T>(ViewContext viewContext, TextWriter writer, T aModel)
        {
            try
            {
                var content = Razor.Parse<T>(template, aModel, cacheName);

                /*
                 Razor.Parse<T>(string template, T model, string name = null);
                 * string template = "Hello @Model.Name! Welcome to Razor!";
                MyModel myModel = new MyModel();
                myModel.Name = "World";

                string result = "";
                result = Razor.Parse<MyModel>(template, myModel);
                */

                writer.Write(content);
                writer.Flush();
            }
            catch (TemplateCompilationException ex)
            {

                ex.Errors.ToList().ForEach(p => Console.WriteLine(p.ErrorText));

            }
            catch (TypeInitializationException ex) {

                
                Console.WriteLine(ex.Message);
                Console.WriteLine(ex.InnerException);
                Console.WriteLine(ex.Source);
                Console.WriteLine(ex.TypeName);
                Console.WriteLine(ex.StackTrace);
               
            }

        }





        /// <summary>
        /// Renders the view into the given <see cref="TextWriter"/>.
        /// 
        /// 뷰Context의 모델과, 템플릿을 결합하여 최종 콘텐츠를 만들어낸다. 
        /// 
        /// </summary>
        /// <param name="viewContext">The <see cref="ViewContext"/> that contains the view data model.</param>
        /// <param name="writer">The <see cref="TextWriter"/> used to write the rendered output.</param>
        public void Render(ViewContext viewContext, TextWriter writer)
        {
            try
            {
                var content = Razor.Parse(template, viewContext.ViewData.Model, cacheName);

                writer.Write(content);
                writer.Flush();
            }
            catch (TemplateCompilationException ex)
            {

                ex.Errors.ToList().ForEach(p => Console.WriteLine(p.ErrorText));

            }
        }

    }
}
