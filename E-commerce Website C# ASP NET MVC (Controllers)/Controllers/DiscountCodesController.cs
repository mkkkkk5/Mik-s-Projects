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
    public class DiscountCodesController : Controller
    {
        private WhatsInMyBagDBEntities db = new WhatsInMyBagDBEntities();

        // GET: DiscountCodes
        [AllowAnonymous]
        public ActionResult Index()
        {
            return View(db.DiscountCodes.ToList());
        }

        // GET: DiscountCodes/Details/5
        [Authorize(Users = "admin1@admin1.com")]
        public ActionResult Details(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            DiscountCode discountCode = db.DiscountCodes.Find(id);
            if (discountCode == null)
            {
                return HttpNotFound();
            }
            return View(discountCode);
        }

        // GET: DiscountCodes/Create
        [Authorize(Users = "admin1@admin1.com")]

        public ActionResult Create()
        {
            return View();
        }

        // POST: DiscountCodes/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        [Authorize(Users = "admin1@admin1.com")]

        public ActionResult Create([Bind(Include = "Id,Code,Percentage")] DiscountCode discountCode)
        {
            if (ModelState.IsValid)
            {
                db.DiscountCodes.Add(discountCode);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            return View(discountCode);
        }

        // GET: DiscountCodes/Edit/5
        [Authorize(Users = "admin1@admin1.com")]

        public ActionResult Edit(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            DiscountCode discountCode = db.DiscountCodes.Find(id);
            if (discountCode == null)
            {
                return HttpNotFound();
            }
            return View(discountCode);
        }

        // POST: DiscountCodes/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        [Authorize(Users = "admin1@admin1.com")]

        public ActionResult Edit([Bind(Include = "Id,Code,Percentage")] DiscountCode discountCode)
        {
            if (ModelState.IsValid)
            {
                db.Entry(discountCode).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            return View(discountCode);
        }

        // GET: DiscountCodes/Delete/5
        [Authorize(Users = "admin1@admin1.com")]

        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            DiscountCode discountCode = db.DiscountCodes.Find(id);
            if (discountCode == null)
            {
                return HttpNotFound();
            }
            return View(discountCode);
        }

        // POST: DiscountCodes/Delete/5
        [Authorize(Users = "admin1@admin1.com")]

        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            DiscountCode discountCode = db.DiscountCodes.Find(id);
            db.DiscountCodes.Remove(discountCode);
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
