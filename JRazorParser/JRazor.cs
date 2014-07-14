using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Web.Mvc;

namespace JRazorParser
{

    public class JRazor
    {
        readonly JViewRenderer htmlViewRenderer;    // 뷰 렌더링 핵심 
       

        /// <summary>
        /// 뷰엔진을 받아 인스턴스 초기화 
        /// </summary>
        /// <param name="viewEngines"></param>
        public JRazor(ViewEngineCollection viewEngines)
        {
            htmlViewRenderer = new JViewRenderer(viewEngines); // 뷰 렌더링 인스턴스 생성         
        }
     
        /// <summary>
        /// Html 로 컨버팅 한다. 특정 모델을 받아들인다..
        /// </summary>
        /// <typeparam name="T"></typeparam>
        /// <param name="lViewInfo"></param>
        /// <param name="aModel"></param>
        /// <returns></returns>
        public string CreateHtml<T>(JView lViewInfo, T aModel)
        {

            var rawHtmlString = htmlViewRenderer.Render<T>(lViewInfo, aModel);
            return rawHtmlString;
        }
    }
}
