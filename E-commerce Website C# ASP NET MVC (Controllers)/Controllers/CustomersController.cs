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
    public class CustomersController : Controller
    {
        private WhatsInMyBagDBEntities db = new WhatsInMyBagDBEntities();

        // GET: Customers
        public ActionResult Index()
        {
            string username = User.Identity.Name;
            if (username == "admin1@admin1.com")
            {
                var cust = db.Customers;
                return View(cust.ToList());

            }
            else
            {
              
                var customer = db.Customers.Where(c => c.UserName == username);
                return View(customer.ToList());
            }
        }

        // GET: Customers/Details/5
        public ActionResult Details(string id)
        {
            string username = User.Identity.Name;

            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Customer customer = db.Customers.Find(id);
            if (customer == null)
            {
                return HttpNotFound();
            }
            if (customer.UserName != username  && User.Identity.Name != "admin1@admin1.com")
            {
                TempData["errorHackAttack"] = "You are not permitted to access this user's information.";
                return RedirectToAction("Index");
            }
            return View(customer);
        }

        // GET: Customers/Create
        public ActionResult Create()
        {
            return View();
        }

        // POST: Customers/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "UserName,Name,Address")] Customer customer)
        {
            var customers = from p in db.Customers
                           select p;
            if (!String.IsNullOrEmpty(customer.Name))
            {
                customers = customers.Where(p => p.Name.Equals(customer.Name));
                if (customers.Count() <= 0)
                {
                    TempData["Message"] = "";
                    db.Customers.Add(customer);
                    db.SaveChanges();
                    return RedirectToAction("Index");
                }
                else
                {
                    TempData["Message"] = "This customer already exists.";
                    return RedirectToAction("Create");
                }
            }
            return View(customer);
        }

        // GET: Customers/Edit/5
        public ActionResult Edit(string id)
        {
            string username = User.Identity.Name;

            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Customer customer = db.Customers.Find(id);
            if (customer == null)
            {
                return HttpNotFound();
            }
            if (customer.UserName != username && User.Identity.Name != "admin1@admin1.com")
            {
                TempData["errorHackAttack"] = "You are not permitted to access this user's information.";
                return RedirectToAction("Index");
            }
            return View(customer);
        }

        // POST: Customers/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "UserName,Name,Address")] Customer customer)
        {
            var customers = from p in db.Customers
                            select p;
            if (!String.IsNullOrEmpty(customer.Name))
            {
                customers = customers.Where(p => p.Name.Equals(customer.Name));
                if (customers.Count() <= 0)
                {
                    TempData["Message"] = "";
                    db.Entry(customer).State = EntityState.Modified;
                    db.SaveChanges();
                    return RedirectToAction("Index");
                }
                else
                {
                    TempData["Message"] = "This name is already taken. Changes were not made.";
                    return RedirectToAction("Index");
                }
            }
            return View(customer);
        }

        // GET: Customers/Delete/5
        [Authorize(Users = "admin1@admin1.com")]

        public ActionResult Delete(string id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Customer customer = db.Customers.Find(id);
            if (customer == null)
            {
                return HttpNotFound();
            }

            return View(customer);
        }

        // POST: Customers/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        [Authorize(Users = "admin1@admin1.com")]

        public ActionResult DeleteConfirmed(string id)
        {
            Customer customer = db.Customers.Find(id);
            Customer detectedCustomer = db.Customers.Find(id);
            var li = db.Carts.ToList();
            foreach (var item in li)
            {
                if (item.CustomerName == detectedCustomer.UserName && item.Status == "unpaid")
                {
                    TempData["errorCustomer"] = "This customer has an unpaid cart.";
                    return RedirectToAction("Index");
                }
            }
            if (detectedCustomer.Carts.Count() > 0)
            {
                TempData["errorDelete"] = "This customer cannot be deleted.";
                return RedirectToAction("Index");
            }
            else
            {
                db.Customers.Remove(customer);
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            
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
