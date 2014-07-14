using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Dynamic;
using System.Web.Mvc;

namespace JRazorParser
{
    public class JView : DynamicObject, IViewDataContainer
    {

        public JView(string viewName)
        {
            if (viewName == null) throw new ArgumentNullException("viewName");
            if (string.IsNullOrWhiteSpace(viewName)) throw new ArgumentException("View name cannot be empty.", "viewName");


            
            ViewName = viewName;                       // 뷰 명칭  
            ViewData = new ViewDataDictionary(this);   // 뷰 데이터 -> You coudn't use this dictinary 
            
        }

       

        /// <summary>Create an Email where the ViewName is derived from the name of the class.
        ///  It will be deprecated..      
        /// </summary>
        /// <remarks>Used when defining strongly typed Email classes.</remarks>
        protected JView()
        {
            
            ViewName = DeriveViewNameFromClassName();
            ViewData = new ViewDataDictionary(this);
        }

        /// <summary>
        /// The name of the view containing the View template.
        /// 템플릿을 포함하는 뷰 이름 
        /// </summary>
        public string ViewName { get; set; }

        /// <summary>
        /// The view data to pass to the view.
        /// 뷰로 전달될 데이터 
        /// </summary>
        public ViewDataDictionary ViewData { get; set; }

        /// <summary>
        /// Stores the given value into the <see cref="ViewData"/>.
        /// </summary>
        /// <param name="binder">Provides the name of the view data property.</param>
        /// <param name="value">The value to store.</param>
        /// <returns>Always returns true.</returns>
        public override bool TrySetMember(SetMemberBinder binder, object value)
        {
            ViewData[binder.Name] = value;
            return true;
        }

        /// <summary>
        /// Tries to get a stored value from <see cref="ViewData"/>.
        /// </summary>
        /// <param name="binder">Provides the name of the view data property.</param>
        /// <param name="result">If found, this is the view data property value.</param>
        /// <returns>True if the property was found, otherwise false.</returns>
        public override bool TryGetMember(GetMemberBinder binder, out object result)
        {
            return ViewData.TryGetValue(binder.Name, out result);
        }

        // It wil be deprecated 
        string DeriveViewNameFromClassName()
        {
            var viewName = GetType().Name;
            if (viewName.EndsWith("Email")) viewName = viewName.Substring(0, viewName.Length - "Email".Length);
            return viewName;
        }
    }
}
