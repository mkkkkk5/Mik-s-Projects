
import React, { useState, useEffect } from "react";
import Card from "../components/Card/Card.js";
import CardBody from "../components/Card/CardBody.js";
import Primary from "../components/Typography/Primary.js";
import { makeStyles } from "@material-ui/core/styles";
import styles from "../assets/jss/material-kit-react/views/loginPage.js";
import Slide from "@material-ui/core/Slide";
import { useHistory } from 'react-router-dom';

const Transition = React.forwardRef(function Transition(props, ref) {
    return <Slide direction="down" ref={ref} {...props} />;
});

Transition.displayName = "Transition";

const useStyles = makeStyles(styles);
//same as auction.js
export default function CurrentBidItems({ id, amount,when, user}) {
    const [anchorEl, setAnchorEl] = useState(null);
    const [cardAnimaton, setCardAnimation] = React.useState("cardHidden");
    setTimeout(function () {
        setCardAnimation("");
    }, 700);
    const classes = useStyles();
    ////console.log('auctionID: ',id)
    const [classicModal, setClassicModal] = React.useState(false);

    // const [userBids, setUserBids] = useState([])
    // useEffect(async () =>
    //   setUserBids(await db.Auctions.findAuctionBidByUser(setUserBids, user.id, id)), []
    // )
    // //console.log("currentBidItems userBids... "+userBids)

    // const [userBids, setUserBids] = useState([])
    // useEffect(async () =>
    //     setUserBids(await db.Auctions.findAuctionBidByUser(user.id)), []
    // )
    // //console.log ("currentBidsItem userbids: ", userBids)

    // const [seller, setSeller] = useState({ name: "" })
    // useEffect(() => {
    //     if (user) {
    //         return db.Users.listenOne(setSeller, sellerId)
    //     }
    // }, [sellerId, user])

    // const [item, setItem] = useState({ name: "" })
    // useEffect(() => db.Users.listenToUserItem(setItem, sellerId, itemId), [sellerId, itemId])

    // const [bids, setBids] = useState([])
    // useEffect(() => db.Auctions.listenToAuctionBids(setBids, id), [id])

    // const [amount, setAmount] = useState(0)

    // const highestBid = () => Math.max(...bids.map(bid => bid.amount), 0)

    // const valid = () => amount > highestBid()

    // const bid = async () => {
    //     await db.Auctions.createAuctionBid(id, { amount, buyerId: user.id, when: new Date() })
    //     setClassicModal(false)
    // }

    const history = useHistory()

    // const attemptBid = () => {
    //     if (user) {
    //         setClassicModal(true)
    //     } else {
    //         history.push("/login")
    //     }
    // }

    // const passIdtoAuctionItem = () => {
    //     //console.log('item obj ',item)
    //     // <AuctionItem key={item.id} />        


    // }


    return (
        
        <Card key={id}>
            <CardBody style={{ textAlign: "center" }}>
    {/* <h1>{`${user.name}`}</h1> */}
                <Primary>Bid Id</Primary>
                <p>{id}</p>
                <Primary>Amount Bid</Primary>
                <p>{amount}</p>
                <Primary>When</Primary>
                <p>{when}</p>
            </CardBody>
            {/* <img className={classes.imgCardBottom} src={item.picture} alt="item-img" /> */}
        </Card>

        //     <>
        //         <GridItem xs={12} sm={12} md={4}>
        //             <Card className={classes[cardAnimaton]}>
        //                 <CardHeader color="primary" className={classes.cardHeader}>
        //                     <img src={item.picture} alt="item" style={{ width: '100px', height: '100px ' }} />
        //                 </CardHeader>
        //                 <CardBody>
        //                     {
        //                         user
        //                         &&
        //                         <>
        //                             <Primary>
        //                                 Seller
        //                             </Primary>
        //                             <Info>
        //                                 {seller.name}
        //                             </Info>
        //                             <br />
        //                         </>
        //                     }
        //                     <Primary>
        //                         Item
        //                 </Primary>
        //                     <Info>
        //                         {item.name}
        //                     </Info>
        //                     <br />
        //                     <Primary>
        //                         High Bid So Far
        //                 </Primary>
        //                     <Info>
        //                         {highestBid()}
        //                     </Info>
        //                 </CardBody>
        //                 <CardFooter className={classes.cardFooter}>
        //                     {
        //                         !user || user.id !== sellerId
        //                             ?
        //                             <Button simple color="primary" size="lg" onClick={attemptBid}>
        //                                 Details and Bid
        //                             </Button>
        //                             // <MenuItem onClick={() => setAnchorEl(null) } component={Link} to={`/auctionItem/${id}`}>Details and Bid</MenuItem>
        //                             :
        //                             null
        //                     }
        //                 </CardFooter>
        //             </Card>
        //         </GridItem>

        //         <Dialog
        //             classes={{
        //                 root: classes.center,
        //                 paper: classes.modal
        //             }}
        //             open={classicModal}
        //             TransitionComponent={Transition}
        //             keepMounted
        //             onClose={() => setClassicModal(false)}
        //             aria-labelledby="classic-modal-slide-title"
        //             aria-describedby="classic-modal-slide-description"
        //         >
        //             <DialogTitle
        //                 id="classic-modal-slide-title"
        //                 disableTypography
        //                 className={classes.modalHeader}
        //             >
        //                 <IconButton
        //                     className={classes.modalCloseButton}
        //                     key="close"
        //                     aria-label="Close"
        //                     color="inherit"
        //                     onClick={() => setClassicModal(false)}
        //                 >
        //                     <Close className={classes.modalClose} />
        //                 </IconButton>
        //                 <h4 className={classes.modalTitle}>Bid on Item</h4>
        //             </DialogTitle>
        //             <DialogContent
        //                 id="classic-modal-slide-description"
        //                 className={classes.modalBody}
        //             >
        //                 Enter an amount higher than {highestBid()}
        //                 <CustomInput
        //                     labelText="Amount"
        //                     id="amount"
        //                     formControlProps={{
        //                         fullWidth: true
        //                     }}
        //                     inputProps={{
        //                         onChange: event => setAmount(event.target.value),
        //                         value: amount,
        //                         type: "number"
        //                     }}
        //                 />
        //             </DialogContent>
        //             <DialogActions className={classes.modalFooter}>
        //                 <Button
        //                     onClick={() => setClassicModal(false)}
        //                     color="danger"
        //                     simple
        //                 >
        //                     Cancel
        //                 </Button>
        //                 <Button color="transparent" simple onClick={bid} disabled={!valid()}>
        //                     Bid
        //                 </Button>

        //             </DialogActions>
        //         </Dialog>
        //     </>
    )
}