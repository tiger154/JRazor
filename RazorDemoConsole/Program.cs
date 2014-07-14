using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using JRazorParser;
using System.Dynamic;

namespace RazorDemoConsole
{
    class Program
    {
        static void Main(string[] args)
        {
            dynamic lJview = new JView("Test");                 // Define View's name
            TModel lModel = new TModel { Name = "YourName" };      // Your Custom Model 

            string lContent = JRazorFactory.Instantance().CreateHtml<TModel>(lJview, lModel);

            Console.ReadLine();

        }
    }
    // Your Custom Model Class 
    public partial class TModel
    {

        public string Name { get; set; }
    }
}
