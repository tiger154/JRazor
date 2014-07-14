﻿using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Web.Mvc;

namespace JRazorParser
{
    /// <summary>
    /// A view engine that uses the Razor engine to render a templates loaded directly from the
    /// file system. This means it will work outside of ASP.NET.
    /// </summary>
    public class FileSystemRazorViewEngine : IViewEngine
    {
        readonly string viewPathRoot;

        /// <summary>
        /// Creates a new <see cref="FileSystemRazorViewEngine"/> that finds views within the given path.
        /// </summary>
        /// <param name="viewPathRoot">The root directory that contains views.</param>
        public FileSystemRazorViewEngine(string viewPathRoot)
        {
            this.viewPathRoot = viewPathRoot;
        }

        string GetViewFullPath(string path)
        {
            return Path.Combine(viewPathRoot, path);
        }

        /// <summary>
        /// Tries to find a razor view (.cshtml or .vbhtml files).
        /// </summary>
        public ViewEngineResult FindPartialView(ControllerContext controllerContext, string partialViewName, bool useCache)
        {
            var possibleFilenames = new List<string>();

            if (!partialViewName.EndsWith(".cshtml", StringComparison.OrdinalIgnoreCase)
                && !partialViewName.EndsWith(".vbhtml", StringComparison.OrdinalIgnoreCase))
            {
                possibleFilenames.Add(partialViewName + ".cshtml");
                possibleFilenames.Add(partialViewName + ".vbhtml");
            }
            else
            {
                possibleFilenames.Add(partialViewName);
            }

            var possibleFullPaths = possibleFilenames.Select(GetViewFullPath).ToArray();

            var existingPath = possibleFullPaths.FirstOrDefault(File.Exists);

            if (existingPath != null)
            {
                return new ViewEngineResult(new FileSystemRazorView(existingPath), this); // 레이저뷰 템플릿 생성, 캐쉬 설정 
            }
            else
            {
                return new ViewEngineResult(possibleFullPaths);
            }
        }

        /// <summary>
        /// Tries to find a razor view (.cshtml or .vbhtml files).
        /// </summary>
        public ViewEngineResult FindView(ControllerContext controllerContext, string viewName, string masterName, bool useCache)
        {
            return FindPartialView(controllerContext, viewName, useCache);
        }

        /// <summary>
        /// Does nothing.
        /// </summary>
        public void ReleaseView(ControllerContext controllerContext, IView view)
        {
            // Nothing to do here - FileSystemRazorView does not need disposing.
        }
    }
}
