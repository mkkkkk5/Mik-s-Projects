using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using WhatsInMyBag.Models;

namespace WhatsInMyBag.Controllers
{
    public class HomeController : Controller
    {
        private WhatsInMyBagDBEntities db = new WhatsInMyBagDBEntities();
        public ActionResult Index()
        {
            var discCode = from c in db.DiscountCodes
                           select c;
            ViewBag.codeList = discCode;
            var products = from p in db.DiscountedProducts
                           select p;
            ViewBag.pList = products;
            return View();
        }

        public ActionResult About()
        {
            ViewBag.Message = "Your application description page.";

            return View();
        }

        public ActionResult Contact()
        {
            ViewBag.Message = "Your contact page.";

            return View();
        }
        public ActionResult FAQ()
        {
            ViewBag.Message = "Your FAQ page.";

            return View();
        }
    }
}