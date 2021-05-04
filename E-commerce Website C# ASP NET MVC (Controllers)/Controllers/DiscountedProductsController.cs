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
    public class DiscountedProductsController : Controller
    {
        private WhatsInMyBagDBEntities db = new WhatsInMyBagDBEntities();

        // GET: DiscountedProducts
        [AllowAnonymous]
        public ActionResult Index()
        {
            return View(db.DiscountedProducts.ToList());
        }

        // GET: DiscountedProducts/Details/5
        [AllowAnonymous]
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            DiscountedProduct discountedProduct = db.DiscountedProducts.Find(id);
            if (discountedProduct == null)
            {
                return HttpNotFound();
            }
            return View(discountedProduct);
        }

        // GET: DiscountedProducts/Create
        [Authorize(Users = "admin1@admin1.com")]

        public ActionResult Create()
        {
            ViewBag.ProductId = new SelectList(db.Products, "Id", "Name");
            return View();
        }

        // POST: DiscountedProducts/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "Id,Discounted_Price,ProductId")] DiscountedProduct discountedProduct)
        {
            if (ModelState.IsValid)
            {
                db.DiscountedProducts.Add(discountedProduct);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            ViewBag.ProductId = new SelectList(db.Products, "Id", "Name", discountedProduct.ProductId);
            return View(discountedProduct);
        }

        // GET: DiscountedProducts/Edit/5
        [Authorize(Users = "admin1@admin1.com")]

        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            DiscountedProduct discountedProduct = db.DiscountedProducts.Find(id);
            if (discountedProduct == null)
            {
                return HttpNotFound();
            }
            ViewBag.ProductId = new SelectList(db.Products, "Id", "Name", discountedProduct.ProductId);
            return View(discountedProduct);
        }

        // POST: DiscountedProducts/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        [Authorize(Users = "admin1@admin1.com")]

        public ActionResult Edit([Bind(Include = "Id,Discounted_Price,ProductId")] DiscountedProduct discountedProduct)
        {
            if (ModelState.IsValid)
            {
                db.Entry(discountedProduct).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            ViewBag.ProductId = new SelectList(db.Products, "Id", "Name", discountedProduct.ProductId);
            return View(discountedProduct);
        }

        // GET: DiscountedProducts/Delete/5
        [Authorize(Users = "admin1@admin1.com")]

        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            DiscountedProduct discountedProduct = db.DiscountedProducts.Find(id);
            if (discountedProduct == null)
            {
                return HttpNotFound();
            }
            return View(discountedProduct);
        }

        // POST: DiscountedProducts/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        [Authorize(Users = "admin1@admin1.com")]

        public ActionResult DeleteConfirmed(int id)
        {
            DiscountedProduct discountedProduct = db.DiscountedProducts.Find(id);
            db.DiscountedProducts.Remove(discountedProduct);
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
