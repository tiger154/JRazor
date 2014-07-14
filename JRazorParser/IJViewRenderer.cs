using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;


namespace JRazorParser
{
    public interface IJViewRenderer
    {
        /// <summary>
        /// Renders a view based on the provided view name.
        /// </summary>
        /// <param name="email">The email data to pass to the view.</param>
        /// <param name="viewName">Optional, the name of the view. If null, the ViewName of the email will be used.</param>
        /// <returns>The string result of rendering the email.</returns>

        string Render<T>(JView aJViewInfo, T aModel, string aViewName = null);
    }
}
