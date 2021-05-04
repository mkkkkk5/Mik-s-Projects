using System;
using System.Collections.Generic;
using System.Data;
using System.Data.Entity;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using WhatsInMyBag.Models;

namespace WhatsInMyBag.Controllers
{
    [Authorize]
    public class ProductsController : Controller
    {
        private WhatsInMyBagDBEntities db = new WhatsInMyBagDBEntities();

        // GET: Products
        [AllowAnonymous]
        public ActionResult Index(string productItem, string search, string sort)
        {
            var items = from i in db.Products
                        select i;
            //creation of dropdown list
            var products = from p in db.Products
                          orderby p.Name
                          select p.Name;
            var productList = new List<String>();
            productList.AddRange(products.Distinct());
            ViewBag.productItem = new SelectList(productList);

            //presenting the filter
            if (!String.IsNullOrEmpty(productItem) && !productList.Equals("All"))
            {
                items = items.Where(i => i.Name.Equals(productItem));
            }
            else if (!String.IsNullOrEmpty(search))
            {
                items = items.Where(i => i.Description.Contains(search));

            }
            else if(sort == "lowtohigh")
            {
                items = items.OrderBy(p => p.Price);
          
            }
            else if (sort == "hightolow")
            {
                items = items.OrderByDescending(p => p.Price);

            }
            return View(items);
        }

       
        [AllowAnonymous]

        // GET: Products/Details/5
        public ActionResult Details(int? id)
        {

            var reviews = from r in db.Reviews
                          select r;
            reviews = reviews.Where(r => r.ProductId == id);
            ViewBag.review = reviews;
         

            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Product product = db.Products.Find(id);
            if (product == null)
            {
                return HttpNotFound();
            }
            return View(product);
        }

        // GET: Products/Create
        [Authorize(Users = "admin1@admin1.com")]

        public ActionResult Create()
        {

            return View();
        }

        // POST: Products/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        [Authorize(Users = "admin1@admin1.com")]

        public ActionResult Create([Bind(Include = "Id,Name,Price,Description")] Product product)
        {

            
            var products = from p in db.Products
                            select p;
            products = products.Where(p => p.Name.Equals(product.Name));
            if (products.Count() <= 0)
            {
                TempData["Message"] = "";
                db.Products.Add(product);
                db.SaveChanges();
                if (product.Price >= 120)
                {
                    double minus = Convert.ToInt32((product.Price / 100) * 10);
                    DiscountedProduct discountP = new DiscountedProduct
                    {
                        Discounted_Price = product.Price - minus,
                        ProductId = product.Id
                    };
                    db.DiscountedProducts.Add(discountP);
                    db.SaveChanges();
                }
                else
                {
                    DiscountedProduct discountP = new DiscountedProduct
                    {
                        Discounted_Price = product.Price,
                        ProductId = product.Id
                    };
                    db.DiscountedProducts.Add(discountP);
                    db.SaveChanges();
                }
                return RedirectToAction("Index");
            }
     
            else
            {
                TempData["Message"] = "This product already exists.";
                return RedirectToAction("Create");
            }
            
        }

        // GET: Products/Edit/5
        [Authorize(Users = "admin1@admin1.com")]

        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Product product = db.Products.Find(id);
            if (product == null)
            {
                return HttpNotFound();
            }
            return View(product);
        }

        // POST: Products/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        [Authorize(Users = "admin1@admin1.com")]

        public ActionResult Edit([Bind(Include = "Id,Name,Price,Description")] Product product)
        {
            if (ModelState.IsValid)
            {
                db.Entry(product).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            return View(product);
        }

        // GET: Products/Delete/5
        [Authorize(Users = "admin1@admin1.com")]

        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Product product = db.Products.Find(id);
            if (product == null)
            {
                return HttpNotFound();
            }
            return View(product);
        }

        // POST: Products/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        [Authorize(Users = "admin1@admin1.com")]

        public ActionResult DeleteConfirmed(int id)
        {
            var li = db.CartItems.ToList();
            Product product = db.Products.Find(id);
            foreach(var item in li)
            {
                if (item.ProductId == product.Id)
                {
                    TempData["errorDelete"] = "Cannote delete this product.";
                    return RedirectToAction("Index");
                }
            }
         
            db.Products.Remove(product);
            db.SaveChanges();
            return RedirectToAction("Index");
        }

        protected override void Dispose(bool disposing)
        {
            if (disposing)
            {
                db.Dispose();
            }
            base.Dispose(disposing);
        }
    }
}
