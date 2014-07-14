using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using System.IO;
using System.Web.Mvc;

namespace JRazorParser
{
    /// <summary>
    /// Jrazor Factory 
    /// Author : John, Won 
    /// 
    /// </summary>
    public sealed class JRazorFactory
    {
        #region >> Field
            private static JRazor mRazor = null;
            private static string mViewPath = null;
            private static string mRoot = System.AppDomain.CurrentDomain.BaseDirectory;
        #endregion

        public JRazor Razor
        {
            get { return mRazor; }
            set { mRazor = value; }
        }

        public string ViewPath {
            get { return mViewPath; }
            set { mViewPath = value; }
        }


        /// <summary>
        /// Default Constructor 
        /// 기본 생성자 
        /// </summary>
        public JRazorFactory(){
           
            
        }        
        
        /// <summary>
        /// 정적 JRazor 초기화 함수 
        /// </summary>
        public static void  InitJRazor(){
            // get View's root path from Config File
            string viewsPath = Path.GetFullPath(mRoot + @"\View");              // 뷰경로 설정 -> 경로는 컨피그로 빼자.. 
            var engines = new ViewEngineCollection();                           // 뷰엔진 생성  
            IViewEngine lFileEngine = new FileSystemRazorViewEngine(viewsPath);
            engines.Add(lFileEngine);                                           // 파일기반의 뷰엔진 으로 설정 추가 -> 뷰패스 설정  

            mRazor = new JRazor(engines);
        }


        public static JRazor Instantance()
        {

            if (mRazor == null)
			{
				lock (typeof (JRazor))
				{
					if (mRazor == null) // double-check
					{	
						InitJRazor();
					}
				}
			}
			return mRazor;
        }

        
    }


    
}
