using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Web;
using System.Web.Mvc;
using WhatsInMyBag.Models;


namespace WhatsInMyBag.Controllers
{
    [Authorize]
    public class TransactionController : Controller
    {
        // GET: Transaction
        private WhatsInMyBagDBEntities db = new WhatsInMyBagDBEntities();

        public ActionResult Index()
        {
            return View();
        }
        //Gets user's username
        //If username is found, username = logged in user 
        //if not found, create a new customer

        //create new cart
        //assign that cart to the user if cart is found
        //if there is no present cart for that user, create a new one

        //return the cart

        private Cart GetUsersCart()
        {
            string username = User.Identity.Name;
            string name = (User.Identity.Name).Split('@')[0];
            try
            {
                db.Customers.First(c => c.UserName.Equals(username));
            }
            catch (Exception)
            {
                db.Customers.Add(new Customer
                {
                    UserName = username,
                    Name = name,
                    Address = "None"
                });
                db.SaveChanges();
            }
            Cart cart = null;
            try
            {
                cart = db.Carts.First(c => c.CustomerName.Equals(username) && c.Status.Equals("unpaid"));
            }
            catch (Exception)
            {

                cart = new Cart { CustomerName = username, Status = "unpaid"};
                db.Carts.Add(cart);
                db.SaveChanges();
            }
            return cart;
        }

        //searches for cart for that specific use
        //if product is found, increment quantity
        //if product is not found. add to cart 
        //returns user to view cart items 
        public ActionResult Buy(int? id)
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
            Cart cart = GetUsersCart();
            try
            {
                CartItem cartitem = db.CartItems.First(c => c.CartId == cart.Id && c.ProductId == product.Id);
                cartitem.Quantity++;
            }
            catch (Exception)
            {
                CartItem cartitem = new CartItem
                {
                    ProductId = product.Id,
                    CartId = cart.Id,
                    Quantity = 1
                };
                db.CartItems.Add(cartitem);
            }
            db.SaveChanges();
            return RedirectToAction("Details", "UserCarts", new { id = cart.Id });
        }

        public ActionResult MyCart()
        {
            Cart cart = GetUsersCart();
            return RedirectToAction("Details", "UserCarts", new { id = cart.Id });
        }

        public ActionResult CheckOut(int? id, string code)
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
            if (cart.CartItems.Count() == 0)
            {
                TempData["message"] = "Your cart is empty.";
            }
            else
            {
                var discProd = db.DiscountedProducts;
                var cartlist = db.CartItems.Where(c => c.CartId == id);
                int total = 0;
                
                foreach (var x in cartlist)
                {
                    var price = db.DiscountedProducts.Where(p => p.ProductId == x.ProductId).First();
                    if(x.ProductId == price.ProductId)
                    {
                        total += x.Quantity * (int)price.Discounted_Price;
                    }
                    else
                        {
                            total += x.Quantity * (int)x.Product.Price;
                        }
                    
                }
                    double newAm = 0.00;
                    double minus = 0.00;
                    var codel = from cl in db.DiscountCodes
                                select cl;
                    if (!String.IsNullOrEmpty(code))
                    {
                        TempData["codeTest"] = "Added "+code ;
                        var codee = db.DiscountCodes.Where(c => c.Code.Equals(code)).First();
                        if (codee != null)
                        {
                            minus = Convert.ToInt32((total / 100) * codee.Percentage);
                            newAm = Convert.ToDouble(total - minus);

                            cart.Amount = (int)newAm;
                            cart.Status = "paid";
                            db.SaveChanges();
                        }

                    }
                    
                    else
                    {
                        cart.Status = "paid";
                        cart.Amount = total;
                        db.SaveChanges();
                    }
            }
            return RedirectToAction("Details", "UserCarts", new { id = cart.Id });
        }
        public ActionResult DeleteItem(int? id)
        {
            var cartItem = db.CartItems.Find(id);
            Cart cart = db.Carts.Find(cartItem.CartId);
            if (cartItem.Quantity > 1)
            {
                cartItem.Quantity--;
                db.SaveChanges();
            }
            else
            {
                db.CartItems.Remove(cartItem);
                db.SaveChanges();
            }
            return RedirectToAction("Details","UserCarts", new { id = cart.Id });
        }

        public ActionResult ShipOut(int? id)
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
            if (cart.CartItems.Count() == 0)
            {
                TempData["message"] = "Your cart is empty.";
            }
            else
            {
                    var cust = db.Customers.Where(c => c.UserName.Equals(cart.CustomerName)).First();
                    int ship = cust.Address.Equals("Doha, Qatar") ? 10 : 20;
                    Shipment shipMent = new Shipment
                    {
                        ShipmentFee = ship,
                        TotalFee = (int)cart.Amount + ship,
                        CartId = cart.Id
                    }; 
                    db.Shipments.Add(shipMent);
                    cart.Status = "Shipped";
                    cart.Amount = shipMent.TotalFee;
                    db.SaveChanges();
                    ViewBag.shipmentFee = shipMent.ShipmentFee;
                    ViewBag.totalFee = shipMent.TotalFee;
                    return RedirectToAction("Details", "Shipments", new { id = shipMent.Id });
               

            }
            return RedirectToAction("Details", "AdminCarts", new { id = cart.Id });
            
        }
    }
}