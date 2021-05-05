import db from '../db'
import React, { useState, useEffect, useContext } from "react";
import UserContext from '../UserContext'
// import { makeStyles } from "@material-ui/core/styles";
// import GridContainer from "../components/Grid/GridContainer.js";
// import GridItem from "../components/Grid/GridItem.js";
// import styles from "../assets/jss/material-kit-react/views/landingPageSections/productStyle.js";
// import CardHeader from "../components/Card/CardHeader.js";

import Auction from '../Trixie/Auction'



// const useStyles = makeStyles(styles);

export default function ItemBySearch(item, id, category, condition, description, name, picture, picture2, picture3, type) {

  const { user } = useContext(UserContext)

  // const classes = useStyles();

  // //console.log(id)

  const [auction, setAuction] = useState([])
  // const [tryAuction,setTry]  = useState([])
  useEffect(() => db.Auctions.listenToAuctionsByItem(setAuction, item.id), [item.id])
  ////console.log("tryAuction ,",tryAuction)

  // const [auction, setAuction] = useState([])
  // useEffect(
  //   () => {
  //     const getData = async () => {
  //       setTry(await db.Auctions.listenToAuctionsByItem(setAuction, id.id))
  //     }
  //     getData()
  //   },
  //   [id.id]
  // )
  ////console.log( "auction by userId...",auction)

  // //console.log(id, "item searched")
  return (
    auction.length !== 0 ?
      <>
        {
          auction.map(auction =>
            <Auction key={auction.id} user={user} {...auction} />
          )
        }
      </>
      :
      null
  )
}
