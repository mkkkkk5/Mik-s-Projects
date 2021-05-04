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
    public class UserCartsController : Controller
    {
        private WhatsInMyBagDBEntities db = new WhatsInMyBagDBEntities();

        // GET: UserCarts
        public ActionResult Index()
        {
          
            var username = User.Identity.Name;
            var carts = db.Carts.Where(c => c.CustomerName == username);
            var shipFee = 0;
            var cust = db.Customers.Where(c => c.UserName == username).First();
            if( cust.Address == "Doha, Qatar")
            {
                shipFee = 10;
            }
            else
            {
                shipFee = 20;
            }
            ViewBag.shipmentFee = shipFee;
            return View(carts.ToList());
        }

        // GET: UserCarts/Details/5
        public ActionResult Details(int? id,string code)
        {

            var cartList = db.CartItems.Where(c => c.CartId == id);
            int totalAmount = 0;
            foreach(var x in cartList)
            {
                totalAmount += x.Quantity * (int)x.Product.Price;
            }
            ViewBag.amount = totalAmount;
            double newAm = 0.00;
            double minus = 0.00;
            var codel = from cl in db.DiscountCodes
                        select cl;
            if (!String.IsNullOrEmpty(code))
            {
                TempData["codeTest"] = code;
                var codee = db.DiscountCodes.Where(c => c.Code.Equals(code)).First();
                if (codee != null)
                {
                    minus = Convert.ToInt32((totalAmount / 100) * codee.Percentage);
                    newAm = Convert.ToDouble(totalAmount - minus);
                    ViewBag.newAmount = newAm;
                    ViewBag.Minus = minus;
                    TempData["discountMessage"] = "Your new total moount is " + newAm + ". You saved " + minus;
                }
            }
            if (String.IsNullOrEmpty(code))
            {
                TempData["discountMessage"] = "";

            }

            string username = User.Identity.Name;

            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Cart cart = db.Carts.Find(id);
            if (cart == null)
            {
                return HttpNotFound();
            } 
           
            if (cart.CustomerName != username && User.Identity.Name != "admin1@admin1.com")
            {
                TempData["errorHackAttack"] = "You are not permitted to access this user's information.";
                return RedirectToAction("Index");
            }
            ViewBag.test = code;

            return View(cart);
        }

        // GET: UserCarts/Create
        public ActionResult Create()
        {
            ViewBag.CustomerName = new SelectList(db.Customers, "UserName", "Name");
            return View();
        }

        // POST: UserCarts/Create
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Create([Bind(Include = "Id,CustomerName,Status,Amount")] Cart cart)
        {
            if (ModelState.IsValid)
            {
                db.Carts.Add(cart);
                db.SaveChanges();
                return RedirectToAction("Index");
            }

            ViewBag.CustomerName = new SelectList(db.Customers, "UserName", "Name", cart.CustomerName);
            return View(cart);
        }

        // GET: UserCarts/Edit/5
        public ActionResult Edit(int? id)
        {
            string username = User.Identity.Name;

            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Cart cart = db.Carts.Find(id);
            if (cart == null)
            {
                return HttpNotFound();
            }
            if (cart.CustomerName != username && User.Identity.Name != "admin1@admin1.com")
            {
                TempData["errorHackAttack"] = "You are not permitted to access this user's information.";
                return RedirectToAction("Index");
            }
            /*var listCust = db.Customers;
            Cart cart2 = db.Carts.Find(id);

            foreach (var item in listCust)
            {
                if(item.UserName != cart2.CustomerName)
                {
                    TempData["errorHacker"] = "You cannot access unauthorized data.";
                    return RedirectToAction("Index");
                }

            }*/
            ViewBag.CustomerName = new SelectList(db.Customers, "UserName", "Name", cart.CustomerName);
            return View(cart);
        }

        // POST: UserCarts/Edit/5
        // To protect from overposting attacks, please enable the specific properties you want to bind to, for 
        // more details see https://go.microsoft.com/fwlink/?LinkId=317598.
        [HttpPost]
        [ValidateAntiForgeryToken]
        public ActionResult Edit([Bind(Include = "Id,CustomerName,Status,Amount")] Cart cart)
        {
           
            if (ModelState.IsValid)
            {
                db.Entry(cart).State = EntityState.Modified;
                db.SaveChanges();
                return RedirectToAction("Index");
            }
            ViewBag.CustomerName = new SelectList(db.Customers, "UserName", "Name", cart.CustomerName);

            return View(cart);
        }
        // GET: UserCarts/Delete/5
        public ActionResult Delete(int? id)
        {
            if (id == null)
            {
                return new HttpStatusCodeResult(HttpStatusCode.BadRequest);
            }
            Cart cart = db.Carts.Find(id);
            if (cart == null)
            {
                return HttpNotFound();
            }
            return View(cart);
        }
        // POST: UserCarts/Delete/5
        [HttpPost, ActionName("Delete")]
        [ValidateAntiForgeryToken]
        public ActionResult DeleteConfirmed(int id)
        {
            string username = User.Identity.Name;

            Cart cart = db.Carts.Find(id);
            
            if(cart.Status == "paid" || cart.Status == "Shipped" && User.Identity.Name != username)
            {
                TempData["errorDeletePaid"] = "Cannot delete an unauthorize cart.";
                return RedirectToAction("Index");
            }
            else
            {
                db.Carts.Remove(cart);
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
