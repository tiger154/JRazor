using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Web.Mvc;
using System.IO;


namespace JRazorParser
{
    public interface IViewExtension : IView
    {
        /// <summary>
        /// 특정 모델을 받아온후 렌더링..  View를 확장하여 사용한다.. 
        /// </summary>
        /// <typeparam name="T"></typeparam>
        /// <param name="viewContext"></param>
        /// <param name="writer"></param>
        /// <param name="aModel"></param>
        void RenderExtension<T>(ViewContext viewContext, TextWriter writer, T aModel);
    }
}
