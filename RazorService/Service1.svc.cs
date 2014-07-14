using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.ServiceModel;
using System.ServiceModel.Web;
using System.Text;
using System.IO;
using JRazorParser;
using System.Dynamic;

namespace RazorService
{
    // 참고: "리팩터링" 메뉴에서 "이름 바꾸기" 명령을 사용하여 코드, svc 및 config 파일에서 클래스 이름 "Service1"을 변경할 수 있습니다.
    public class Service1 : IService1
    {
        public string GetData(int value)
        {
            return string.Format("You entered: {0}", value);
        }

        public CompositeType GetDataUsingDataContract(CompositeType composite)
        {
            if (composite == null)
            {
                throw new ArgumentNullException("composite");
            }
            if (composite.BoolValue)
            {
                composite.StringValue += "Suffix";
            }
            return composite;
        }


        public void GetRazorDemo()
        {

            dynamic lJview = new JView("Test");                 // Define View's name
            TModel lModel = new TModel{Name = "YourName"};      // Your Custom Model 
           
            string lContent = JRazorFactory.Instantance().CreateHtml<TModel>(lJview, lModel);
                
            
        }
    }

    // Your Custom Model Class 
    public partial class TModel {

        public string Name { get; set; }
    }
}
